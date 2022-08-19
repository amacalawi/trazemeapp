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

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $requestData['password'] = Hash::make($requestData['password']);

        $user = User::create($requestData);

        return response([ 'status' => true, 'message' => 'User successfully register.' ], 200);
    }

    public function login(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if(! auth()->attempt($requestData)){
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        $batchID = (new Batch)->get_current_batch();

        $sql = Staff::select([
            'users.id',
            \DB::raw('CONCAT("Employee") as level'), 
            'users.name', 
            'users.type',
            'staffs.gender',
            'staffs.identification_no',
            \DB::raw('CONCAT("") as section'), 
        ])
        ->join('users', function($join)
        {
            $join->on('users.id', '=', 'staffs.user_id');
        })
        ->join('enrollments_staffs', function($join)
        {
            $join->on('enrollments_staffs.staff_id', '=', 'staffs.id');
        })
        ->where([
            'enrollments_staffs.batch_id' => $batchID,
            'users.id' => auth()->user()->id,
            'users.is_active' => 1
        ]);
            
        $res = Student::select([
            'users.id',
            'levels.name as level', 
            'users.name', 
            'users.type',
            'students.gender',
            'students.identification_no',
            'sections.name as section'
        ])
        ->join('users', function($join)
        {
            $join->on('users.id', '=', 'students.user_id');
        })
        ->join('enrollments', function($join)
        {
            $join->on('enrollments.student_no', '=', 'students.identification_no');
        })
        ->join('sections_info', function($join)
        {
            $join->on('sections_info.id', '=', 'enrollments.section_info_id');
        })
        ->join('sections', function($join)
        {
            $join->on('sections.id', '=', 'sections_info.section_id');
        })
        ->join('levels', function($join)
        {
            $join->on('levels.id', '=', 'enrollments.level_id');
        })
        ->where([
            'enrollments.batch_id' => $batchID,
            'enrollments.status' => 'admitted',
            'users.id' => auth()->user()->id,
            'users.is_active' => 1
        ])
        ->union($sql)
        ->get();

        if ($res->count() > 0) {
            return response(['user' => $res->first(), 'access_token' => $accessToken], 200);
        } else {
            return response(['user' => auth()->user(), 'access_token' => $accessToken], 200);
        }   
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json(['user' => $user], 200);
    }

    public function logout (Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}