<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class StaticText extends Model
{
    protected $table = 'static_text';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
