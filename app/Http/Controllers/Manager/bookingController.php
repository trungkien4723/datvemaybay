<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Passenger;
use App\Models\Seat_class;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\sendMail;
use Illuminate\Support\Str;

class bookingController extends Controller
{

    protected $bookingModel;
    protected $flightModel;
    protected $passengerModel;
    protected $seatClassModel;
    protected $userModel;
    
    public function __construct(Booking $booking, Flight $flight, Passenger $passenger, Seat_class $seatClass, User $user)
    {
        $this->bookingModel = $booking;
        $this->flightModel = $flight;
        $this->passengerModel = $passenger;
        $this->seatClassModel = $seatClass;
        $this->userModel = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $bookings = $this->bookingModel->search($request->search);

            return response()->json([
                'code' => 200,
                'component' => view('manage.booking.booking_tbl')->with(['bookings' => $bookings,])->render(),
            ],200);
        }
        else
        {
            $bookings = $this->bookingModel->latest('id')->paginate(10);
            return view('manage.booking.index')->with(['bookings' => $bookings]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flights = $this->flightModel->get();
        $passengers = $this->passengerModel->get();
        $seatClasses = $this->seatClassModel->get();
        return view("manage.booking.create")->with(['flights' => $flights, 'passengers' => $passengers, 'seatClasses' => $seatClasses,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkExist = $this->passengerModel->where('email', '=', $request->email)->first();
        $user = $this->userModel->where('email', '=', $request->email)->first();
        if($checkExist == null){
            $dataCreate = $request->all();
            if(!$user == null)
            {
                $dataCreate['user_ID'] = $user->id;
            }
            $passenger = $this->passengerModel->create($dataCreate);
        }
        else
        {
            $passenger = $checkExist;
        }

        $flight = $this->flightModel->findOrFail($request->flight_ID);
        $price = $flight->price;
        if($request->seat_class_ID == 1){$price = $price * 5;}
        else if($request->seat_class_ID == 2){$price = $price * 4;}
        else if($request->seat_class_ID == 4){$price = $price * 2;}
        $price = ($price * $request->adult) 
        + (($price - ($price * 30 / 100)) * $request->children)
        + (($price - ($price * 50 / 100)) * $request->infant);

        if(now()->diffInDays($flight->start_time) < 2){
            $price = $price * 5;
        }
        else if(now()->diffInDays($flight->start_time) < 10){
            $price = $price * 3;
        }
        else if(now()->diffInDays($flight->start_time) < 30){
            $price = $price * 2;
        }
        
        // $ticketData = session()->get('ticket');
        // $dataCreate = array();
        $bookingIDs = array();
        // foreach($ticketData as $item)
        // {
            $key = "HNK".Str::random(6);
            while($this->bookingModel->where('booking_key', $key)->exists()) {
                $key = "HNK".Str::random(6);
            }

            $dataCreate = [
                'booking_key' => $key,
                'booked_time' => now(),
                'flight_ID' => $request->flight_ID,
                'passenger_ID' => $passenger->id,        
                'adult' => $request->adult,
                'children' => $request->children,
                'infant' => $request->infant,
                'seat_class_ID' => $request->seat_class_ID,
                'total_price' => $price,
            ];
         
            $booking = $this->bookingModel->create($dataCreate);
            array_push($bookingIDs,$booking->id);
        // }

        if($passenger){
            // $flightIDs = array();
            // foreach(session()->get('ticket') as $item)
            // {
            //     array_push($flightIDs,$item['flight_ID']);
            // }
            $flights = $this->flightModel->select('flight.*', 'booking.*')
            ->leftJoin('booking', 'booking.flight_ID', '=', 'flight.id')
            ->where('flight.id', '=', $request->flight_ID)
            ->whereIn('booking.id', $bookingIDs)->get();
            $ticketData[$request->flight_ID] = ['price' => $price];
            $data = [
                'flights' => $flights,
                'booking' => $booking,
                'passenger' => $passenger,
                'ticket' => $ticketData,
            ];
            sendMail::dispatch($data, $passenger)->delay(now()->addMinute(1));
        }
        return redirect()->route('bookings.index')->with('message', 'Th??m th??nh c??ng');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = $this->bookingModel->findOrFail($id);
        $passenger = $this->passengerModel->findOrFail($booking->passenger_ID);
        $flights = $this->flightModel->get();
        $seatClasses = $this->seatClassModel->get();
        return view('manage.booking.edit')
        ->with(['booking'=> $booking,
            'passenger' =>$passenger,
            'flights' => $flights,
            'seatClasses' => $seatClasses,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking = $this->bookingModel->findOrFail($id);
        $passenger = $this->passengerModel->findOrFail($booking->passenger_ID);
        $user = $this->userModel->where('email', '=', $request->email)->first();

        $dataCreate = $request->all();

        if($user){$dataCreate['user_ID'] = $user->id;}

        $passenger->update($dataCreate);


        $flight = $this->flightModel->findOrFail($request->flight_ID);
        $oldFlight = $this->flightModel->findOrFail($booking->flight_ID);

        $originalPrice = $flight->price;
        $oldOriginalPrice = $oldFlight->price;
        $bookedPrice = $booking->total_price;
        $newPrice = ($originalPrice * ($bookedPrice * 100 / $oldOriginalPrice)) / 100;

            $dataCreate = [
                'booked_time' => now(),
                'flight_ID' => $request->flight_ID,
                'passenger_ID' => $passenger->id,
                'seat_class_ID' => $request->seat_class_ID,
                'total_price' => $newPrice,
            ];
         
        $booking->update($dataCreate);
        return redirect()->route('bookings.index')->with('message', 'C???p nh???t th??nh c??ng');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking=$this->bookingModel->destroy($id);
        return redirect()->route('bookings.index')->with('message', 'X??a th??nh c??ng');
    }

    public function active($id)
    {
        $booking = $this->bookingModel->findOrFail($id);
        $booking->update(['status'=>1]);
        return redirect()->route('bookings.index')->with('message', 'K??ch ho???t th??nh c??ng');
    }

    public function unActive($id)
    {
        $booking = $this->bookingModel->findOrFail($id);
        $booking->update(['status'=>0]);
        return redirect()->route('bookings.index')->with('message', 'T???m ng??ng th??nh c??ng');
    }
}
