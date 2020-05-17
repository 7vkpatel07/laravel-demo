<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{

    public $table = "users";
    public $timestamps = false;
    use Notifiable;
    use Sortable;
    use SoftDeletes;



    public $sortable = [
        'id',
        'first_name',
        'last_name',
        'first_name_en',
        'last_name_en',
        'email',
        'status',
        'created_at',
        'updated_at'
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id','id');
    }

    public function userSkills()
    {
        return $this->hasMany('App\UsersSkills');
        //return $this->hasMany('App\UsersSkills', 'skill_id','user_id');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Skills','users_skills','user_id', 'skill_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id','id');
    }



}
