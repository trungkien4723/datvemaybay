<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use App\Models\Booking;
use Illuminate\Http\Request;

class passengerController extends Controller
{

    protected $passengerModel;
    protected $bookingModel;

    public function __construct(Passenger $passenger, Booking $booking)
    {
        $this->passengerModel = $passenger;
        $this->bookingModel = $booking;
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
                'status' => 'Đang kích hoạt',
            ];
            
        }
        
        $booking = $this->bookingModel->create($dataCreate);

        session()->flush('ticket');
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
