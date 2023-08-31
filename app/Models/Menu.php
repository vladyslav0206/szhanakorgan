<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function images()
    {
        return $this->hasMany('App\Models\Images', 'menu_id', 'id');
    }
}
