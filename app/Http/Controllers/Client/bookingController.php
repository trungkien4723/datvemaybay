<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\City;
use App\Models\Seat_class;
use App\Models\Flight;
use Illuminate\Http\Request;

class bookingController extends Controller
{
    protected $bookingModel;
    protected $seatClassModel;
    protected $cityModel;
    protected $flightModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, Seat_class $seatClass, City $city, Flight $flight)
    {
        $this->seatClassModel = $seatClass;
        $this->cityModel = $city;
        $this->flightModel = $flight;
        $this->bookingModel = $booking;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function store()
    {
        $dataCreate = array();
        $dataCreate = [
            'passenger_ID' => $passenger->id
        ];
        $booking = $this->bookingModel->create($dataCreate);
        return redirect()->route('home.index');
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
}
