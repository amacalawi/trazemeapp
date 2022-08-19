<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HdfLog extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'hdf_logs';
    
    public $timestamps = false;
}