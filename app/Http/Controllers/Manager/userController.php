<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Traits\handleImageTrait;
use App\Models\User;
use Auth;

class userController extends Controller
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
            $q->where('name','!=','super-admin')->where('name','!=','admin');
        })->latest('id')->paginate(10);
        return view('manage.user.index')->with('users', $users);
    }

    public function index_admin()
    {
        $users = $this->userModel->whereHas('roles', function($q){
            $q->where('name','!=','super-admin')->where('name','!=','user');
        })->latest('id')->paginate(10);
        return view('manage.user.admin_index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleModel->where('name', '!=', 'super-admin')->get();
        return view('manage.user.create', compact('roles'));
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

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('message', 'Thêm thành công');
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
        $roles = $this->roleModel->where('name', '!=', 'super-admin')->get();
        $listRoleIds = $user->roles->pluck('id')->toArray();

        return view('manage.user.edit')->with(['user'=> $user, 'roles' =>$roles, 'listRoleIds' =>$listRoleIds]);
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
        $user->syncRoles($request->roles);
        return redirect()->route('users.index')->with('message', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=$this->userModel->destroy($id);
        return redirect()->route('users.index')->with('message', 'Xóa thành công');
    }
}
