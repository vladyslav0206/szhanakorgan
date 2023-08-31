<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class FeedBack extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
