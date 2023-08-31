<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function category(){

        $category = Category::where('id',$this->category_id)->first();
        return $category;
    }
}
