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
use App\Models\Slider;
use App\Models\Ticket;
use App\Models\Booking;
use App\Models\Booked_seat;
use App\Models\Capacity;

class HomeController extends Controller
{
    protected $userModel;
    protected $seatClassModel;
    protected $cityModel;
    protected $airportModel;
    protected $aircraftModel;
    protected $flightModel;
    protected $bookingModel;
    protected $bookedSeatModel;
    protected $capacityModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Seat_class $seatClass, City $city, Airport $airport, Aircraft $aircraft, Flight $flight, Booking $booking, Booked_seat $bookedSeat, Capacity $capacity)
    {
        $this->userModel = $user;
        $this->seatClassModel = $seatClass;
        $this->cityModel = $city;
        $this->airportModel = $airport;
        $this->aircraftModel = $aircraft;
        $this->flightModel = $flight;
        $this->bookingModel = $booking;
        $this->bookedSeatModel = $bookedSeat;
        $this->capacityModel = $capacity;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slider = Slider::orderBy('id','DESC')->where('status','=',1)->take(4)->get();
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
        session()->forget('ticket');
        session()->forget('maxChoose');
        $slider = Slider::orderBy('id','DESC')->where('status','1')->take(4)->get();
        $cities = $this->cityModel->get();
        $seatClasses = $this->seatClassModel->get();
        $startCity = $this->cityModel->find($request->flight_from);
        $arriveCity = $this->cityModel->find($request->flight_to);
        $seatClass = $this->seatClassModel->find($request->seat_class);
        $startDate = date("d-m-Y", strtotime($request->date_from));
        $backDate = date("d-m-Y", strtotime($request->date_to));

        if($request->has('check_date_back')){
            $validatedData = $request->validate([
                'date_from' => 'before:date_to',
            ]);
            session()->put('maxChoose', 2);
        }
        else{
            $backDate = null;
            session()->put('maxChoose', 1);
        }
        
        $flights = $this->flightModel
        ->join('airport AS start', 'start.id', '=', 'flight.start_airport_ID')
        ->join('airport AS arrive', 'arrive.id', '=', 'flight.arrive_airport_ID')
        ->select('flight.*')
        ->where('start.city_ID', '=', $startCity->id)
        ->where('arrive.city_ID', '=', $arriveCity->id)
        ->whereDate('flight.start_time', '=', date("Y-m-d", strtotime($startDate)))
        ->get();
        $totalPassenger = $request->adult + $request->children + $request->infant;
        $flightInfo = [
            'startCity' => $startCity,
            'arriveCity' => $arriveCity,
            'seatClass' => $seatClass,
            'startDate' => $startDate,
            'backDate' => $backDate,
            'adult' => $request->adult,
            'children' => $request->children,
            'infant' => $request->infant,
            'flights' => $flights,
        ];

        session()->put('flightInfo', $flightInfo);
        $bookedSeats = $this->bookedSeatModel->get();

        return view('client.home.booking')->with([
            'slider' => $slider,            
            'cities' => $cities,
            'seatClasses' => $seatClasses,
        ]);
    }

    public function addFlight($id)
    {
        $cities = $this->cityModel->get();
        $seatClasses = $this->seatClassModel->get();
        
        if(session()->get('ticket')){
            if(count(session()->get('ticket')) >= session()->get('maxChoose')){session()->forget('ticket');}
        }//Xoa ve cu khi dat lai ve khac
        
        $flight = $this->flightModel->find($id);

        $flightInfo = session()->get('flightInfo');
        $price = $flight->price;
        if($flightInfo['seatClass']->id == 1){$price = $price * 5;}
        else if($flightInfo['seatClass']->id == 2){$price = $price * 4;}
        else if($flightInfo['seatClass']->id == 4){$price = $price * 2;}

        if(now()->diffInDays($flightInfo['startDate']) < 2){
            $price = $price * 5;
        }
        else if(now()->diffInDays($flightInfo['startDate']) < 10){
            $price = $price * 3;
        }
        else if(now()->diffInDays($flightInfo['startDate']) < 30){
            $price = $price * 2;
        }

        $totalPrice = ($price * $flightInfo['adult']) 
        + (($price - ($price * 30 / 100)) * $flightInfo['children'])
        + (($price - ($price * 50 / 100)) * $flightInfo['infant']);

        $ticket = session()->get('ticket');
        $ticket[$id] = [
            'flight_ID' => $id,
            'aircraft_ID' => $flight->aircraft_ID,
            'start_airport_ID' => $flight->start_airport_ID,
            'start_city' => $flightInfo['startCity'],
            'start_time' => $flight->start_time,
            'arrive_airport_ID' => $flight->arrive_airport_ID,
            'arrive_city' => $flightInfo['arriveCity'],
            'arrive_time' => $flight->arrive_time,
            'price' => $price,
            'total_price' => $totalPrice,
        ];

        $flights = session()->get('flightInfo');

        if(session()->get('maxChoose') >= 2)
        {
            $startCity = session()->get('flightInfo')['arriveCity'];
            $arriveCity = session()->get('flightInfo')['startCity'];
            $seatClass = session()->get('flightInfo')['seatClass'];
            $startDate = date("d-m-Y", strtotime(session()->get('flightInfo')['startDate']));
            $backDate = date("d-m-Y", strtotime(session()->get('flightInfo')['backDate']));
            $adult = session()->get('flightInfo')['adult'];
            $children = session()->get('flightInfo')['children'];
            $infant = session()->get('flightInfo')['infant'];
            $flights = $this->flightModel
            ->join('airport AS start', 'start.id', '=', 'flight.start_airport_ID')
            ->join('airport AS arrive', 'arrive.id', '=', 'flight.arrive_airport_ID')
            ->select('flight.*')
            ->where('start.city_ID', '=', $startCity->id)
            ->where('arrive.city_ID', '=', $arriveCity->id)
            ->whereDate('flight.start_time', '=', date("Y-m-d", strtotime($backDate)))
            ->get();

            $flightInfo = [
                'startCity' => $startCity,
                'arriveCity' => $arriveCity,
                'seatClass' => $seatClass,
                'startDate' => $startDate,
                'backDate' => $backDate,
                'adult' => $adult,
                'children' => $children,
                'infant' => $infant,
                'flights' => $flights,
            ];

            session()->put('flightInfo', $flightInfo);
        }
        
        session()->put('ticket', $ticket);
        return response()->json([
            'code' => 200,
            'component' => view('client.layout.booking_list')->with(['cities' => $cities, 'seatClasses' => $seatClasses,])->render(),
        ],200);
    }
    
    public function showMyFlightForm()
    {
        $slider = Slider::orderBy('id','DESC')->where('status','=',1)->take(4)->get();
        return view('client.my_flight.index')->with(['slider' => $slider,]);
    }
    public function showMyFlight(Request $request)
    {
        $bookingKey = $request->booking_key;
        $slider = Slider::orderBy('id','DESC')->where('status','=',1)->take(4)->get();
        $booking = $this->bookingModel->where('booking_key', '=', $bookingKey)->first();
        $flight = $this->flightModel->where('id', '=', $booking->flight_ID)->first();
        return view('client.my_flight.show')->with(['slider' => $slider, 'flight' => $flight, 'booking' => $booking]);
    }
}
