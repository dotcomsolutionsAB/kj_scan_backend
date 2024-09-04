<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MumeneenModel;

class UpdateController extends Controller
{
    //

    public function user(Request $request)
    {
        $get_user = Auth::User();

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);

        $update_user_record = User::where('id', $get_user)
        ->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
        ]);

        if ($update_user_record == 1) {
            return response()->json([
                'message' => 'User record updated successfully!',
                'data' => $update_user_record
            ], 200);
        }
        
        else {
            return response()->json([
                'message' => 'Failed to user record successfully'
            ], 400);
        }   
    }

    public function mumeneen(Request $request, $id)
    {
        $request->validate([
            'its' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'arabic_name' => 'required',
        ]);

        $update_record = MumeneenModel::where('id', $id)
        ->update([
            'its' => $request->input('its'),
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'arabic_name' => $request->input('arabic_name'),
        ]);

        if ($update_record == 1) {
            return response()->json([
                'message' => 'Mumeneen record updated successfully!',
                'data' => $update_record
            ], 200);
        }
        
        else {
            return response()->json([
                'message' => 'Failed to mumeneen record successfully'
            ], 400);
        }   
    }
}
