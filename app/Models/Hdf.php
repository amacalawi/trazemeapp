<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hdf extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'hdf';
    
    public $timestamps = false;
}