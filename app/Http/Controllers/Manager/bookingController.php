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
    public function index()
    {
        $bookings = $this->bookingModel->latest('id')->paginate(10);
        return view('manage.booking.index')->with(['bookings' => $bookings]);
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
        // foreach($ticketData as $item)
        // {
            $dataCreate = [
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
        // }

        if($passenger){
            // $flightIDs = array();
            // foreach(session()->get('ticket') as $item)
            // {
            //     array_push($flightIDs,$item['flight_ID']);
            // }
            $flights = $this->flightModel->select('flight.*')->where('id', '=', $request->flight_ID)->get();
            $ticketData[$request->flight_ID] = ['price' => $price];
            $data = [
                'flights' => $flights,
                'booking' => $booking,
                'passenger' => $passenger,
                'ticket' => $ticketData,
            ];
            sendMail::dispatch($data, $passenger)->delay(now()->addMinute(1));
        }
        return redirect()->route('bookings.index')->with('message', 'Thêm thành công');
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
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function active($id)
    {
        $booking = $this->bookingModel->findOrFail($id);
        $booking->update(['status'=>1]);
        return redirect()->route('bookings.index')->with('message', 'Kích hoạt thành công');
    }

    public function unActive($id)
    {
        $booking = $this->bookingModel->findOrFail($id);
        $booking->update(['status'=>0]);
        return redirect()->route('bookings.index')->with('message', 'Tạm ngưng thành công');
    }
}
