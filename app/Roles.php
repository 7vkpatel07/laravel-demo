<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    public $timestamps = false;
	use Sortable;
	use SoftDeletes;

	public $sortable = [
		'id',
		'role_name',
		'role_name_en',
		'created_at',
		'updated_at'
	];
}
