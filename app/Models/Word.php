<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table = "word";
    protected $fillable = [
    	'address','user_id'
	];
}
