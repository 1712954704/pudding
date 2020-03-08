<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Users extends Authenticatable
{
    protected $table = 'users';
    protected $fillable = ['name','email','password'];
    protected $hidden = ['password','remember_token'];
}
