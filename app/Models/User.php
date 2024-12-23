<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function staffProvinces()
    {
        return $this->hasMany(StaffProvince::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'staff_id');
    }
}
