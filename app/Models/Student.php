<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'students';
    
    public $timestamps = false;
}