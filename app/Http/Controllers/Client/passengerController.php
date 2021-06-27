<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Http\Request;
use App\Jobs\sendMail;

class passengerController extends Controller
{

    protected $passengerModel;
    protected $bookingModel;
    protected $flightModel;

    public function __construct(Passenger $passenger, Booking $booking, Flight $flight)
    {
        $this->passengerModel = $passenger;
        $this->bookingModel = $booking;
        $this->flightModel = $flight;
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
        $checkExist = $this->passengerModel->where('email', '=', $request->email)->first();
        //$checkRelative = $checkExist->where('')->get;
        if($checkExist == null){
            $dataCreate = $request->all();
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

        $ticketData = session()->get('ticket');
        $dataCreate = array();
        foreach($ticketData as $item)
        {
            $dataCreate = [
                'booked_time' => now(),
                'flight_ID' => $item['flight_ID'],
                'passenger_ID' => $passenger->id,        
                'adult' => $request->adult,
                'children' => $request->children,
                'infant' => $request->infant,
                'seat_class_ID' => $request->seatClass,
                'total_price' => $item['price'],
            ];
         
            $booking = $this->bookingModel->create($dataCreate);
        }

        if($passenger){
            $flightIDs = array();
            foreach($ticketData as $item)
            {
                array_push($flightIDs,$item['flight_ID']);
            }
            $flights = $this->flightModel->select('flight.*')->whereIn('id', $flightIDs)->get();
            $data = [
                'flights' => $flights,
                'booking' => $booking,
                'passenger' => $passenger,
                'ticket' => $ticketData,
            ];
            sendMail::dispatch($data, $passenger)->delay(now()->addMinute(1));
        }
        
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
