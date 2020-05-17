<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersSkills extends Model
{
    public $table = "users_skills";
    public $timestamps = true;


    public function skills()
    {
        return $this->belongsTo('App\Skills');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }


}
