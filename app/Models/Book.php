<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Book extends Model
{
    protected $table = 'book';
    protected $primaryKey = 'id';
    //public $timestamps = false;
}
