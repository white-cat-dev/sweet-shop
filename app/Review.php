<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function client()
	{
		return $this->belongsTo(Client::class);
	}

    public function image()
	{
		return $this->belongsTo(Image::class);
	}

	public function cake()
	{
		return $this->belongsTo(Cake::class);
	}

}