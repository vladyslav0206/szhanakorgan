<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Contact extends Model
{
    protected $table = 'contact';
    protected $primaryKey = 'contact_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
