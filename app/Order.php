<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{
	
	protected $fillable = [
		'client_id',
		'execution_date',
		'count',
		'status',
		'comment',
		'cost'
	];

	static $statuses = [
		1 => 'Новый',
		2 => 'Текущий',
		3 => 'Отклоненный',
		4 => 'Выполненный'
	];

    
   	public function client()
	{
		return $this->belongsTo(Client::class);
	}

	public function cakes()
	{
		return $this->belongsToMany(Cake::class)->withPivot('quantity');
	}

}