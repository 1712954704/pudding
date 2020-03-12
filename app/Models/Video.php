<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	protected $table = 'video';
    protected $fillable = [
    	'name','address','user_id'
	];
}
