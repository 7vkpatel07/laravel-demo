<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modules extends Model
{

	public $timestamps = false;
	use Sortable;
	use SoftDeletes;

	public $sortable = [
		'id',
		'name',
		'created_at',
		'updated_at'
	];
}
