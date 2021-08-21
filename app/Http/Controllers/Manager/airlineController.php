<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;
use App\Traits\handleImageTrait;

class airlineController extends Controller
{

    use handleImageTrait;

    protected $path;

    protected $airlineModel;

    public function __construct(Airline $airline)
    {
        $this->airlineModel = $airline;
        $this->path = 'images/airline/';
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
            $airlines = $this->airlineModel->search($request->search);

            return response()->json([
                'code' => 200,
                'component' => view('manage.airline.airline_tbl')->with(['airlines' => $airlines,])->render(),
            ],200);
        }
        else
        {
            $airlines = $this->airlineModel->latest('id')->paginate(10);
            return view('manage.airline.index')->with('airlines', $airlines);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.airline.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $dataCreate = $request->all();
        $dataCreate['logo'] = $this->saveImage($image, $this->path);

        $airline = $this->airlineModel->create($dataCreate);

        return redirect()->route('airlines.index')->with('message', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function show(Airline $airline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $airline = $this->airlineModel->findOrFail($id);

        return view('manage.airline.edit')->with('airline', $airline);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $airline = $this->airlineModel->findOrFail($id);
        $image = $request->file('image');

        $dataUpdate = $request->all();

        $dataUpdate['logo'] = $this->updateImage($image, $this->path, $airline->logo);

        $airline->update($dataUpdate);

        return redirect()->route('airlines.index')->with('message', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $airline=$this->airlineModel->destroy($id);
        return redirect()->route('airlines.index')->with('message', 'Xóa thành công');
    }
}
