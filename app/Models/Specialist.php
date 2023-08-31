<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Specialist extends Model
{
    protected $table = 'specialists';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
