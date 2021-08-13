<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
// use Hash;

class User extends Authenticatable
{
    use Notifiable,HasRoles;

    protected $table = "user";

    protected $fillable = [
        'name',
        'email',
        'ID_number',
        'gender',
        'birthday',
        'address',
        'phone',
        'password',
        'image',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }

    public function searchUser($query)
    {
        return $this->whereHas('roles', function($q){
            $q->where('name','!=','super-admin')->where('name','!=','admin');
        })->where(function($q) use ($query){
            $q->where('name', 'like', '%'.$query.'%')
                    ->orWhere('email', 'like', '%'.$query.'%')
                    ->orWhere('ID_number', 'like', '%'.$query.'%')
                    ->orWhere('address', 'like', '%'.$query.'%')
                    ->orWhere('phone', 'like', '%'.$query.'%');
        })->latest('id')->paginate(10);
    }

    public function searchAdmin($query)
    {
        return $this->whereHas('roles', function($q){
            $q->where('name','!=','super-admin')->where('name','!=','user');
        })->where(function($q) use ($query){
            $q->where('name', 'like', '%'.$query.'%')
                    ->orWhere('email', 'like', '%'.$query.'%')
                    ->orWhere('ID_number', 'like', '%'.$query.'%')
                    ->orWhere('address', 'like', '%'.$query.'%')
                    ->orWhere('phone', 'like', '%'.$query.'%');
        })->latest('id')->paginate(10);
    }

    public static function findOrFail($id)
    {
        return User::with('roles')->findOrFail($id);
    }

    public function changePassword($id, $password)
    {
        return $this->findOrFail($id)->update(['password' => $password]);
    }

}

