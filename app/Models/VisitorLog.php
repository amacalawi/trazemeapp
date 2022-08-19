<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'visitor_logs';
    
    public $timestamps = false;
}