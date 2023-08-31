<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Images extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
