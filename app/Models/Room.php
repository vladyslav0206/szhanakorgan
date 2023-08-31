<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Room extends Model
{
    protected $table = 'room';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
