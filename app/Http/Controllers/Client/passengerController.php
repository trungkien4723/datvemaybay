<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use App\Models\Booking;
use App\Models\Booked_seat;
use App\Models\Flight;
use Illuminate\Http\Request;
use App\Jobs\sendMail;
use Illuminate\Support\Str;

class passengerController extends Controller
{

    protected $passengerModel;
    protected $bookingModel;
    protected $flightModel;
    protected $bookedSeatModel;

    public function __construct(Passenger $passenger, Booking $booking, Flight $flight, Booked_seat $bookedSeat)
    {
        $this->passengerModel = $passenger;
        $this->bookingModel = $booking;
        $this->flightModel = $flight;
        $this->bookedSeatModel = $bookedSeat;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $ad=0;$ch=0;$inf=0;
        $mailData = array();
        $mailTo = 0;
        for($i=0; $i < count($request->last_name); $i++)
        {
            //$checkRelative = $checkExist->where('')->get;
            if($i == 0){
                $checkExist = $this->passengerModel->where('email', '=', $request->input('email')[0])->first();
                if($checkExist == null){
                    $dataCreate = [
                        'first_name' => $request->input('first_name')[$i],
                        'last_name' => $request->input('last_name')[$i],
                        'gender' => $request->input('gender')[$i],
                        'email' => $request->input('email')[$i],
                        'ID_number' => $request->input('ID_number')[$i],
                        'phone' => $request->input('phone')[$i],
                    ];
                    if(auth()->check())
                    {
                        $dataCreate['user_ID'] = auth()->user()->id;
                    }
                    $passenger = $this->passengerModel->create($dataCreate);
                }
                else
                {
                    $passenger = $checkExist;
                }
                $mailTo = $passenger;
            }
            else{
                $dataCreate = [
                    'first_name' => $request->input('first_name')[$i],
                    'last_name' => $request->input('last_name')[$i],
                    'gender' => $request->input('gender')[$i],
                ];
                if($i < $request->adult){
                    $dataCreate['ID_number'] = $request->input('ID_number')[$i];
                    $dataCreate['phone'] = $request->input('phone')[$i];
                }
                if(auth()->check())
                {
                    $dataCreate['user_ID'] = auth()->user()->id;
                }
                $passenger = $this->passengerModel->create($dataCreate);
            }
            
            $ticketData = session()->get('ticket');
            $dataCreate = array();
            $bookingIDs = array();
            foreach($ticketData as $item)
            {
                $key = "HNK".Str::random(6);
                while($this->bookingModel->where('booking_key', $key)->exists()) {
                    $key = "HNK".Str::random(6);
                }

                $dataCreate = [
                    'booking_key' => $key,
                    'booked_time' => now(),
                    'flight_ID' => $item['flight_ID'],
                    'passenger_ID' => $passenger->id,
                    'seat_class_ID' => $request->seatClass,
                    'total_price' => 0,
                ];
                if($ad < $request->adult){$dataCreate['total_price'] = $item['price'];}
                else if($ch < $request->children){$dataCreate['total_price'] = $item['price'] - ($item['price']*30/100);}
                else if($inf < $request->infant){$dataCreate['total_price'] = $item['price'] - ($item['price']*50/100);}
                
                $booking = $this->bookingModel->create($dataCreate);
                array_push($bookingIDs,$booking->id);
                
            }

            if($passenger){
                $flightIDs = array();
                foreach($ticketData as $item)
                {
                    array_push($flightIDs,$item['flight_ID']);
                }
                $flights = $this->flightModel->select('flight.*', 'booking.*')
                ->leftJoin('booking', 'booking.flight_ID', '=', 'flight.id')
                ->whereIn('flight.id', $flightIDs)
                ->whereIn('booking.id', $bookingIDs)->get();
                $data = [
                    'flights' => $flights,
                    'booking' => $booking,
                    'passenger' => $passenger,
                    'adult' => $request->adult,
                    'children' => $request->children,
                    'infant' => $request->infant,
                    'ticket' => $ticketData,
                ];
                array_push($mailData, $data);
            }
            if($ad < $request->adult){$ad++;}
            else if($ch < $request->children){$ch++;}
            else if($inf < $request->infant){$inf++;}
        }
        $ticketData = session()->get('ticket');
        foreach($ticketData as $item)
        {
            $flightInfo = session()->get('flightInfo');
            $dataCreate = [
                'flight_ID' => $item['flight_ID'],
                'seat_class_ID' => $request->seatClass,
                'booked_seat' => $flightInfo['adult'] + $flightInfo['children'] + $flightInfo['infant'],
            ];
            $bookedSeat = $this->bookedSeatModel->create($dataCreate);
        }

        sendMail::dispatch($mailData, $mailTo)->delay(now()->addMinute(1));

        
        session()->forget('ticket');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function show(Passenger $passenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passenger $passenger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passenger $passenger)
    {
        //
    }
}
