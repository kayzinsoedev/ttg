<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;
    protected $table = 'jobs';
    protected $fillable = ['name','place','image','quantity'];


    public function user(){
      return $this->belongsTo('App\User','user_id');
    }
}
