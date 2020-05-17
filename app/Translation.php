<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translation extends Model
{
	use Sortable;

	public $table = "translation";
	public $timestamps = false;
	use SoftDeletes;

	public $sortable = [
		'id',
		'english_text',
		'translated_text',
		'created_at',
		'updated_at'
	];

	public function modules()
	{
		return $this->hasOne('App\Modules','id','module_id');
	}
}
