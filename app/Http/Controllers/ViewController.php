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
        
        if (isset($get_user_records) && (!$get_user_records->isEmpty())) {
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

    public function mumeneen()
    {    
        $get_user_records = MumeneenModel::select('its', 'name', 'mobile', 'gender', 'age', 'arabic_name')->get();
        
        if (isset($get_user_records) && (!$get_user_records->isEmpty())) {
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

    public function events()
    {
        $get_all_event_records = EventModel::select('id', 'event_name', 'date', 'status', 'description')->get();

        if (isset($get_all_event_records) && (!$get_all_event_records->isEmpty())) {
            return response()->json([
                'message' => 'Fetch all events records successfully!',
                'data' => $get_all_event_records
            ], 200);
        }

        else {
            return response()->json([
                'message' => 'Failed to fetch events records',
                'data' => 'Error'
            ], 400);
        }
    }
    
    public function get_events()
    {
        $get_all_events = EventModel::select('id', 'event_name')->get();

        if (isset($get_all_events) && (!$get_all_events->isEmpty())) {
            return response()->json([
                'message' => 'Fetch events records successfully!',
                'data' => $get_all_events
            ], 200);
        }

        else {
            return response()->json([
                'message' => 'Failed to fetch events records',
                'data' => 'Error'
            ], 400);
        }
    }
}
