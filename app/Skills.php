<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skills extends Model
{

	public $timestamps = false;
    use Sortable;
    use SoftDeletes;

    public $sortable = [
		'id',
		'skill_name',
		'skill_name_en',
		'skill_access_level',
		'skill_status',
		'created_at',
		'updated_at'
	];

	 public function users()
    {
        return $this->belongsToMany('App\User');
    }




}
