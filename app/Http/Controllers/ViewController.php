<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MumeneenModel;
use App\Models\EventModel;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    //
    public function user()
    {    
        $get_user_records = User::select('name','email','mobile')->where('id', Auth::id())->get();
        
        if (isset($get_user_records) || (!$get_user_orders->isEmpty())) {
            return response()->json([
                'message' => 'Fetch data successfully!',
                'data' => $get_user_records
            ], 200);
        }

        else {
            return response()->json([
                'message' => 'Failed to fetch data',
                'data' => 'Error'
            ], 400);
        }
    }
}
