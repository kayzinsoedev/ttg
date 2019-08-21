<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Term extends Model
{
  use SoftDeletes;
  protected $table = 'terms';
  protected $fillable = ['terms_and_conditions'];
}
