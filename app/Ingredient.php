<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cake;


class Ingredient extends Model 
{
	
	protected $fillable = [
		'title',
		'units',
		'count'
	];

	protected $casts = [
		'count' => 'float'
 	];

}