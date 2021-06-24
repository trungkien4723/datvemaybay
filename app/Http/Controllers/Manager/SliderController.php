<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\handleImageTrait;

class sliderController extends Controller
{
    use handleImageTrait;

    protected $path;
    protected $sliderModel;

    public function __construct(Slider $slider)
    {
        $this->path = "images/slider/";
        $this->sliderModel = $slider;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = $this->sliderModel->latest('id')->paginate(10);
        return view('manage.slider.index')->with(['sliders' => $sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.slider.create');
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
        $dataCreate['image'] = $this->saveImage($image, $this->path);

        $slider = $this->sliderModel->create($dataCreate);

        return redirect()->route('sliders.index')->with('message', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider=$this->sliderModel->destroy($id);
        return redirect()->route('sliders.index')->with('message', 'Xóa thành công');
    }

    public function active($id)
    {
        $slider = $this->sliderModel->findOrFail($id);
        $slider->update(['status'=>1]);
        return redirect()->route('sliders.index')->with('message', 'Kích hoạt thành công');
    }

    public function unActive($id)
    {
        $slider = $this->sliderModel->findOrFail($id);
        $slider->update(['status'=>0]);
        return redirect()->route('sliders.index')->with('message', 'Ẩn thành công');
    }
}
