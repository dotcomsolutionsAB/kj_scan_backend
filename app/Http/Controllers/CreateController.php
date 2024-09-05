<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScansModel;
use Illuminate\Support\Facades\Auth;
use App\Models\MumeneenModel;

class CreateController extends Controller
{
    //
    public function scanning(Request $request)
    {
        $request->validate([
            'event_id' => 'required|integer',
            'its' => 'required|integer',
        ]);

        $get_existing_record = ScansModel::where('event_id', $request->input('event_id'))
                                            ->where('its',  $request->input('its'))
                                            ->get();

        $get_memeneen_name = MumeneenModel::where('its', $request->input('its'))->first();

        if ($get_memeneen_name == null) {
            $memeneen_name = 'Mehmaan';
        }

        else {
            $memeneen_name = $get_memeneen_name->name;
        }
        
        if ($get_existing_record->isEmpty()) {

            // $response = [];  // Initialize an array to accumulate responses.

            if ($get_memeneen_name == null) {

                // return response()->json([
                //     'error' => 'Input Gender',
                // ], 422);
                echo "User not present";
                // Instead of stopping execution, store the error message
                // $response['errors'][] = 'User not present';

                $request->validate([
                    'gender' => 'required|string|in:male,female',
                ]);

                $memeneen_gender = $request->input('gender');
            }

            else {
                $get_memeneen_records = MumeneenModel::select('gender')
                                                        ->where('its', $request->input('its'))->first();

                $memeneen_gender = $get_memeneen_records->gender;
            }

            $create_scan = ScansModel::create([
                'event_id' => $request->input('event_id'),
                'its' => $request->input('its'),
                'entered_by' => Auth::id(),
                'gender' => $memeneen_gender,
            ]);

            $get_total_count = ScansModel::count();
            $get_male_count = ScansModel::where('gender', 'male')->count();
            $get_female_count = ScansModel::where('gender', 'female')->count();
            
            $count_records = array([
                'total_record' => $get_total_count,
                'total_male_record' => $get_male_count,
                'total_female_record' => $get_female_count,
            ]);

            // $get_user = Auth::user();
            $get_memeneen_name = 
            $get_scan_record = array([
                'event_id' => $create_scan->event_id,
                'its' => $create_scan->its,
                // 'entered_by' => $get_user->name,
                'name' => $memeneen_name,
                'gender' => $memeneen_gender,
            ]);

            if (isset($get_scan_record)) {

                // $get_mumeneen_record = MumeneenModel::select('name')->where('its',  $create_scan->its)->get();
                // dd($get_mumeneen_record[0]->name);
                return response()->json([
                    'message' => 'Scan created successfully!',
                    'data' => $get_scan_record,
                    'record_counts' => $count_records,
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
            $memeneen_gender = ScansModel::select('gender')
                                            ->where('its', $request->input('its'))->get();

            $get_total_count = ScansModel::count();
            $get_male_count = ScansModel::where('gender', 'male')->count();
            $get_female_count = ScansModel::where('gender', 'female')->count();
            
            $count_records = array([
                'total_record' => $get_total_count,
                'total_male_record' => $get_male_count,
                'total_female_record' => $get_female_count,
            ]);
            $get_scan_record = array([
                'event_id' => $request->input('event_id'),
                'its' => $request->input('its'),
                // 'entered_by' => $get_user->name,
                'name' => $memeneen_name,
                'gender' => $memeneen_gender[0]->gender,
                'record_counts' => $count_records,
            ]);



            return response()->json([
                'message' => 'Already exists!',
                'error' => 'The combination of event ID and ITS already exists.',
                'data' => $get_scan_record,
            ], 422);
        }     
    }
}
