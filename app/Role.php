<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $table = 'roles';
    protected $fillable = ['name', 'description'];


    /**
     * Get the users
     *
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get the permissions
     *
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'role_permission');
    }
}
