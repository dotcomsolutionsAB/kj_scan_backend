<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScansModel;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    //
    public function scanning(Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'its' => 'required',
        ]);

        $get_existing_record = ScansModel::where('event_id', $request->input('event_id'))
                                            ->where('its', 123456)
                                            ->get();
        
        if ($get_existing_record->isEmpty()) {
            $create_scan = ScansModel::create([
                'event_id' => $request->input('event_id'),
                'its' => $request->input('its'),
                'entered_by' => Auth::id(),
            ]);

            $get_user = Auth::user();
            $get_scan_record = array([
                'event_id' => $create_scan->event_id,
                'its' => $create_scan->its,
                'entered_by' => $get_user->name,
            ]);

            if (isset($get_scan_record)) {
                return response()->json([
                    'message' => 'Scan created successfully!',
                    'data' => $get_scan_record
                ], 201);
            }
    
            else {
                return response()->json([
                    'message' => 'Failed to create successfully!',
                    'data' => 'error'
                ], 400);
            }  
        }

        else {
            return response()->json([
                'message' => 'Already exists!',
                'error' => 'The combination of event ID and ITS already exists.'
            ], 422);
        }     
    }
}
