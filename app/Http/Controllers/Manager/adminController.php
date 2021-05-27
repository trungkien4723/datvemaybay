<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Traits\handleImageTrait;
use App\Models\User;
use Auth;

class adminController extends Controller
{
    use handleImageTrait;

    protected $path;

    protected $userModel;
    protected $roleModel;

    public function __construct(User $user, Role $role)
    {
        $this->userModel = $user;
        $this->path = 'images/user/';
        $this->roleModel = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userModel->whereHas('roles', function($q){
            $q->where('name','!=','super-admin')->where('name','!=','user');
        })->latest('id')->paginate(10);
        return view('manage.admin_user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.admin_user.create');
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

        $user = $this->userModel->create($dataCreate);

        $user->syncRoles('admin');

        return redirect()->route('manage.admin_user.index')->with('message', 'Đã thêm quản trị viên');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userModel->with('roles')->findOrFail($id);
        return view('manage.admin_user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->userModel->findOrFail($id);
        $image = $request->file('image');

        $dataUpdate = $request->all();

        $dataUpdate['image'] = $this->updateImage($image, $this->path, $user->image);

        $user->update($dataUpdate);
        $user->syncRoles('admin');
        return redirect()->route('admins.index')->with('message', 'Cập nhật thông tin người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
