<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Batch;
use App\Models\VisitorLog;
use App\Models\Laboratory;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ScannerController extends Controller
{   
    private $carbon;

    public function __construct(Carbon $carbon)
    {   
        date_default_timezone_set('Asia/Manila');
        $this->carbon = $carbon;
    }

    public function time_elapsed_string($datetime, $full = false) {
        $now = new Carbon;
        $ago = new Carbon($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function scan_lists(Request $request)
    {   
        $labID = $request->get('laboratory_id');
        $batch = (new Batch)->get_current_batch();

        $res = VisitorLog::select([
            'visitor_logs.id as id',
            'users.name as name',
            'visitor_logs.created_at as time',
            'users.type as type',
            'users.username as username'
        ])
        ->leftJoin('users', function($join) {
            $join->on('visitor_logs.user_id', '=', 'users.id');
        })
        ->where([
            'visitor_logs.batch_id' => $batch,
            'visitor_logs.laboratory_id' => $labID,
            'visitor_logs.is_active' => 1
        ])
        ->get();
        
        if (!$res) {
            throw new NotFoundHttpException();
        }

        $res = $res->map(function($vis) {
            return (object) [
                'id' => $vis->id,
                'name' => $vis->name,
                'noti' => 'has successfully logged in.',
                'time' => $this->time_elapsed_string($vis->time),
                'img' => 'http://www.smartschoolapp.com/images/'.$vis->type.'s/'.ltrim($vis->username, $vis->username[0]).'.JPG'
            ];
        });


        return response()
        ->json($res);
    }

}