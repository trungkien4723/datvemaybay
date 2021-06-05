<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Aircraft;
use App\Models\Airline;
use Illuminate\Http\Request;

class aircraftController extends Controller
{

    protected $aircraftModel;
    protected $airlineModel;

    public function __construct(Aircraft $aircraft, Airline $airline)
    {
        $this->aircraftModel = $aircraft;
        $this->airlineModel = $airline;
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
        $airlines = $this->airlineModel->get();
        return view('manage.aircraft.create')->with("airlines", $airlines);
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

        return view('manage.aircraft.edit')->with(['aircraft' => $aircraft, 'airlines' => $airlines]);
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
