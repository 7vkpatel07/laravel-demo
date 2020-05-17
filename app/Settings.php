<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use Sluggable;
    use Sortable;
    use SoftDeletes;

    public $sortable = [
		'id',
		'field',
		'slug',
		'value',
		'created_at',
		'updated_at'
	];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'field'
            ]
        ];
    }
}
