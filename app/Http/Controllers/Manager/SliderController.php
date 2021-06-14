<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Session;
use App\Http\Requests;
use App\Traits\handleImageTrait;
use Illuminate\Support\Facades\Redirect;
use DB;
class SliderController extends Controller
{
    use handleImageTrait;

    protected $path;
    protected $sliderModel;

    public function __construct(Slider $slider)
    {
        $this->sliderModel = $slider;
        $this->path = 'images/slider/';
    }

    public function manage_slider(){
    	$all_slide = Slider::orderBy('id','DESC')->get();
    	return view('manage.slider.list_slider')->with(compact('all_slide'));
    }
    public function add_slider(){
    	return view('manage.slider.add_slider');
    }
    public function unactive_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slide_id)->update(['slider_status'=>0]);
        Session::put('message','Không kích hoạt slider thành công');
        return Redirect::to('manage-slider');

    }
    public function active_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slide_id)->update(['slider_status'=>1]);
        Session::put('message','Kích hoạt slider thành công');
        return Redirect::to('manage-slider');

    }

    public function insert_slider(Request $request){
    	
        $image = $request->file('image');
        $data = $request->all();
        $data['image'] = $this->saveImage($image, $this->path);
      
        if($image){
            $slider = $this->sliderModel->create($data);
            return redirect()->route('add_slider')->with('message', 'Thêm thành công');
        }else{
        	return redirect()->route('add_slider')->with('message', 'Hãy chèn hình ảnh');
        }
       	
    }
}
