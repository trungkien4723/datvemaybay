<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\City;
use Illuminate\Http\Request;

class airportController extends Controller
{
    protected $airportModel;
    protected $cityModel;

    public function __construct(Airport $airport, City $city)
    {
        $this->airportModel = $airport;
        $this->cityModel = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airports = $this->airportModel->latest('id')->paginate(10);
        return view('manage.airport.index')->with('airports', $airports);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = $this->cityModel->get();
        $airports = $this->airportModel->get();
        return view('manage.airport.create')->with(["airports" => $airports, "cities" => $cities]);
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

        $aircraft = $this->airportModel->create($dataCreate);

        return redirect()->route('airports.index')->with('message', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function show(Airport $airport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = $this->cityModel->get();
        $airport = $this->airportModel->findOrFail($id);

        return view('manage.airport.edit')->with(["airport" => $airport, "cities" => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $airport = $this->airportModel->findOrFail($id);

        $dataUpdate = $request->all();

        $airport->update($dataUpdate);

        return redirect()->route('airports.index')->with('message', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $airport=$this->airportModel->destroy($id);
        return redirect()->route('airports.index')->with('message', 'Xóa thành công');
    }
}
