<?php
namespace App\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AricleVerifiedAtScope implements Scope
{
	public function apply(Builder $builder, Model $model)
	{
//		return $builder->whereNotNull('email_verified_at');
		return $builder->where('status',1);
	}
}
