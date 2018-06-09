<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredient;
use App\Image;
use DB;

class Cake extends Model 
{

	protected $fillable = [
		'title',
		'description',
		'image_id',
		'price',
		'weight'
	];


	public function ingredients() 
	{
		return $this->belongsToMany(Ingredient::class)->withPivot('quantity');
	}

	public function image()
	{
		return $this->belongsTo(Image::class);
	}

}