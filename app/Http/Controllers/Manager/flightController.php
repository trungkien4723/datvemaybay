<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Aircraft;
use Illuminate\Http\Request;

class flightController extends Controller
{

    protected $airportModel;
    protected $flightModel;
    protected $aircraftModel;

    public function __construct(Airport $airport, Flight $flight, Aircraft $aircraft)
    {
        $this->airportModel = $airport;
        $this->flightModel = $flight;
        $this->aircraftModel = $aircraft;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flights = $this->flightModel->latest('id')->paginate(10);
        return view('manage.flight.index')->with('flights', $flights);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flights = $this->flightModel->get();
        $airports = $this->airportModel->get();
        $aircrafts = $this->aircraftModel->get();
        return view('manage.flight.create')->with(["airports" => $airports, "flights" => $flights, "aircrafts" => $aircrafts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'start_time' => 'before:arrive_time',
        ]);
        $dataCreate = $request->all();

        $flight = $this->flightModel->create($dataCreate);

        return redirect()->route('flights.index')->with('message', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function show(Flight $flight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function edit(Flight $flight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flight $flight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flight $flight)
    {
        //
    }
}