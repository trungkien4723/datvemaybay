<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;
use App\Models\Seat_class;
use App\Models\City;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Aircraft;

class HomeController extends Controller
{
    protected $userModel;
    protected $seatClassModel;
    protected $cityModel;
    protected $airportModel;
    protected $aircraftModel;
    protected $flightModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Seat_class $seatClass, City $city, Airport $airport, Aircraft $aircraft, Flight $flight)
    {
        $this->userModel = $user;
        $this->seatClassModel = $seatClass;
        $this->middleware('auth');
        $this->cityModel = $city;
        $this->airportModel = $airport;
        $this->aircraftModel = $aircraft;
        $this->flightModel = $flight;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slider = Slider::orderBy('id','DESC')->where('status','1')->take(4)->get();
        $seatClasses = $this->seatClassModel->get();
        $cities = $this->cityModel->get();
        return view('client.home.index')->with(['seatClasses' => $seatClasses, "cities" => $cities, "slider" => $slider]);
    }

    public function showChangePasswordForm()
    {
        return view('auth.passwords.changepassword');
    }
    
    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Nhập sai mật khẩu hiện tại.");
        }

        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Mật khẩu mới không được trùng với mật khẩu cũ.");
        }

        $customValidationMessages = [
            'new_password.confirmed' => 'Nhập lại mật khẩu chưa chính xác'
            ];

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',            
        ], $customValidationMessages);

        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with("success","Đổi mật khẩu thành công !");

    }

    public function showBookingPage(Request $request)
    {
        $startCity = $this->cityModel->find($request->flight_from);
        $arriveCity = $this->cityModel->find($request->flight_to);
        $seatClass = $this->seatClassModel->find($request->seat_class);
        $startDate = date("d-m-Y", strtotime($request->date_from));
        $backDate = date("d-m-y", strtotime($request->date_to));
        $date = $startDate;
        $flights = $this->flightModel
        ->leftJoin('airport AS start', 'start.id', '=', 'flight.start_airport_ID')
        ->where('start.city_ID', '=', $startCity->id)
        ->leftJoin('airport AS arrive', 'arrive.id', '=', 'flight.arrive_airport_ID')
        ->where('arrive.city_ID', '=', $arriveCity->id)
        ->whereDate('flight.start_time', '=', date("Y-m-d", strtotime($date)))
        ->get();
        $aircrafts = $this->aircraftModel->get();
        if($request->has('check_date_back')){
            //
        }
        else{
            $backDate = null;
        }
        $totalPassenger = $request->adult + $request->children + $request->infant;
        

        return view('client.home.booking')->with([
            'startCity' => $startCity,
            'arriveCity' => $arriveCity,
            'seatClass' => $seatClass,
            'startDate' => $startDate,
            'backDate' => $backDate,
            'totalPassenger' => $totalPassenger,
            'flights' => $flights,
            'aircrafts' => $aircrafts,
        ]);
    }
    
}
