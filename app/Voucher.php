<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use SoftDeletes;
    protected $table = 'vouchers';
    protected $fillable = ['voucher_code', 'discount', 'type','valid'];
}
