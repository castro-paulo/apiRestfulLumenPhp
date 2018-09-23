<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{	
	protected $table = 'package';
	
	protected $fillable = [
		'name','value','beginDate','endDate','description','urlImage','site','phone'
	];

	protected $casts = [
		'beginDate' => 'Timestamp',
		'endDate' => 'Timestamp'
	];

	public $timestamps = false;
}
