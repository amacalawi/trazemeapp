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
use App\Models\Hdf;
use App\Models\HdfLog;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class HdfController extends Controller
{   
    private $carbon;

    public function __construct(Carbon $carbon)
    {   
        date_default_timezone_set('Asia/Manila');
        $this->carbon = $carbon;
    }

    public function register(Request $request)
    {
        // return response([ 'status' => true, 'message' => 'User successfully register.' ], 200);
    }

    public function register_hdf(Request $request)
    {   
        $batch = (new Batch)->get_current_batch();
        $user = User::where(['id' => $request->get('user_id')])->get();
        $arrs = array();
        foreach ($request->selected as $select) {
            $arrs[] = $select;
        }

        if ($user->count() > 0) {
            $user = $user->first();
            $logs =  HdfLog::create([
                'batch_id' => $batch,
                'user_id' => $user->id,
                'symptoms' => implode(',', $arrs),
                'created_at' => $this->carbon::now(),
                'created_by' => $user->id
            ]);

            $hdf = Hdf::where(['user_id' => $user->id])->get();
            if ($hdf->count() > 0) {
                $res = Hdf::find($hdf->first()->id);
                if(!$res) {
                    throw new NotFoundHttpException();
                }
                $res->user_id = $user->id;
                $res->symptoms = implode(',', $arrs);
                $res->updated_at = $this->carbon::now();
                $res->updated_by = Auth::user()->id;
                $res->update();
            } else {
                $res =  Hdf::create([
                    'user_id' => $user->id,
                    'symptoms' => implode(',', $arrs),
                    'created_at' => $this->carbon::now(),
                    'created_by' => $user->id
                ]);
            }

            return response()
            ->json([
                'status' => 'ok',
                'data' => $res
            ]);

        } else {
            return response()
            ->json([
                'status' => 'not',
                'data' => $request->selected
            ]);
        }
    }
}