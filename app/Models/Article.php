<?php

namespace App\Models;

use App\Scopes\AricleVerifiedAtScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Article extends Model
{
	use SoftDeletes;
    protected $table = 'article';
    protected $fillable = [
    	'title','content','user_id'
	];
    protected $hidden = [
	];
    
    // 设置软删除字段
	protected $dates = ['deleted_at'];
	
	protected static function boot()
	{
		parent::boot();
		
		static::addGlobalScope(new AricleVerifiedAtScope());
	}
}
