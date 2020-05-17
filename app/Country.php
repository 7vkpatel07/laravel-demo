<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    public $table = "country";
    public $timestamps = false;

    use Sortable;
    use SoftDeletes;

    public $sortable = [
        'id',
        'country_name',
        'country_name_en',
        'country_code',
        'created_at',
        'updated_at'
    ];

    


}
