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


    public function scopeWithRole($query, $role)
    {
        $query->when($role,
        fn($query, $q) => $query->whereHas('roles', fn($q) => $q->where('name', $role)));
    }

    public function scopeWithName($query,$name)
    {
        $query->when($name,fn($q)=>$q->where('name','LIKE','%'.$name.'%'));
    }


    public function scopeWithEmail($query, $email)
    {
        $query->when($email,fn($q)=>$q->where('email','LIKE','%'.$email.'%'));
    }

    public function scopeWithAddress($query, $address)
    {
        $query->when($address,fn($q)=>$q->where('address','LIKE','%'.$address.'%'));
    }

    public function scopeWithPhone($query, $phone)
    {
        $query->when($phone,fn($q)=>$q->where('phone','LIKE','%'.$phone.'%'));
    }

    public function search(array $condition)
    {
        return $this->withName($condition['name'])
                    ->withEmail($condition['email'])
                    ->withRole($condition['role'])
                    ->withAddress($condition['address'])
                    ->latest('id')
                    ->paginate(10);
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

