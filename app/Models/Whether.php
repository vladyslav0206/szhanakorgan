<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Whether extends Model
{
    protected $table = 'whether';
    protected $primaryKey = 'id';
}
