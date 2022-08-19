<?php

namespace App\Models;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'batches';
    
    public $timestamps = false;

    public function get_current_batch()
    {   
        if (Auth::user()) {
            if (Auth::user()->batch_id > 0) {
                return Auth::user()->batch_id;
            } else {
                return self::where('status', 'Current')->first()->id;
            }
        } else {
            return self::where('status', 'Current')->first()->id;
        }
    }
}

