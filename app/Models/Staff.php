<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'staffs';
    
    public $timestamps = false;
}