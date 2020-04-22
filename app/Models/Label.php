<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $table = 'label';
    protected $fillable = [
    	'pid','title','user_id'
	];
    protected $hidden = [
    	'updated_at','created_at',
	];
}
