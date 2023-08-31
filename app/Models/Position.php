<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Position extends Model
{
    protected $table = 'position';
    protected $primaryKey = 'position_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
