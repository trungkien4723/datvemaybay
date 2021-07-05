<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Aircraft;
use App\Models\Airline;
use App\Models\Capacity;
use App\Models\Seat_class;
use Illuminate\Http\Request;

class aircraftController extends Controller
{

    protected $aircraftModel;
    protected $airlineModel;
    protected $capacityModel;
    protected $seatClassModel;

    public function __construct(Aircraft $aircraft, Airline $airline, Capacity $capacity, Seat_class $seatClass)
    {
        $this->aircraftModel = $aircraft;
        $this->airlineModel = $airline;
        $this->capacityModel = $capacity;
        $this->seatClassModel = $seatClass;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aircrafts = $this->aircraftModel->latest('id')->paginate(10);
        return view('manage.aircraft.index')->with('aircrafts', $aircrafts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seatClasses = $this->seatClassModel->get();
        $airlines = $this->airlineModel->get();
        return view('manage.aircraft.create')->with(["airlines" => $airlines, 'seatClasses' => $seatClasses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataCreate = $request->all();

        $aircraft = $this->aircraftModel->create($dataCreate);
        //dd(count($request->capacity_input));
        for($i = 0; $i < count($request->capacity_input); $i++)
        {
            $capacityData = [
                'aircraft_ID' => $aircraft->id,
                'seat_class_ID' => $i+1,
                'capacity' => $request->capacity_input[$i],
            ];
            
            $capacity = $this->capacityModel->create($capacityData);
        }

        return redirect()->route('aircrafts.index')->with('message', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function show(Aircraft $aircraft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aircraft = $this->aircraftModel->findOrFail($id);
        $airlines = $this->airlineModel->get();
        $seatClasses = $this->seatClassModel->get();

        return view('manage.aircraft.edit')->with(['aircraft' => $aircraft, 'airlines' => $airlines, 'seatClasses' => $seatClasses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aircraft = $this->aircraftModel->findOrFail($id);

        $dataUpdate = $request->all();

        $aircraft->update($dataUpdate);

        for($i = 0; $i < count($request->capacity_input); $i++)
        {
            $capacityData = $this->capacityModel->where('aircraft_ID', '=', $id)->where('seat_class_ID', '=', $i+1)->first();
            $capacityData = [
                'aircraft_ID' => $id,
                'seat_class_ID' => $i+1,
                'capacity' => $request->capacity_input[$i],
            ];
            
            $capacity->update($capacityData);
        }

        return redirect()->route('aircrafts.index')->with('message', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aircraft=$this->aircraftModel->destroy($id);
        return redirect()->route('aircrafts.index')->with('message', 'Xóa thành công');
    }
}
