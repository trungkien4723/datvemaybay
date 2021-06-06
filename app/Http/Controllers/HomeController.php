<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;
use App\Models\Seat_class;

class HomeController extends Controller
{
    protected $userModel;
    protected $seatClassModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Seat_class $seatClass)
    {
        $this->userModel = $user;
        $this->seatClassModel = $seatClass;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $seatClasses = $this->seatClassModel->get();
        return view('client.home.index')->with('seatClasses', $seatClasses);
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
}
