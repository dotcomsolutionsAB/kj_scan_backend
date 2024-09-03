<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CsvImportController extends Controller
{
    //
    public function importUser()
    {
        // URL of the CSV file from Google Sheets
        $get_product_user_url = '';

        // Fetch the CSV content using file_get_contents
        $csvContent_user = file_get_contents($get_product_user_url);

        // Fetch and parse the CSV
        $csv_user = Reader::createFromString($csvContent_user);

        $csv_user->setHeaderOffset(0); // Set the header offset
        

        $records_user = (new Statement())->process($csv_user);

        // Iterate through each record and create or update the product
        foreach ($records_user as $record_user) {
            $user_csv = User::where('mobile', $record_user['Mobile '])->first();

            // Handle potential empty values for email, pincode, and markup
            $email_user = !empty($record_user['Email']) ? $record_user['Email'] : null;
            $pincode_user = $record_user['Pincode'] !== '' ? $record_user['Pincode'] : 0;
            $markup_user = $record_user['Mark Up'] !== '' ? $record_user['Mark Up'] : 0;

            if ($user_csv) 
            {
                // If product exists, update it
                $user_csv->update([
                    'name' => $record_user['Name'],
                    'email' => $email_user,
                    'password' => bcrypt($record_user['Mobile ']),
                    'otp' => null,
                    'expires_at' => null,
                    'address_line_1' => $record_user['Address Line 1'],
                    'address_line_2' => $record_user['Address Line 2'],
                    'city' => $record_user['City'],
                    'pincode' => $pincode_user,// Ensure this is a valid number
                    'gstin' => $record_user['GSTIN'],
                    'state' => $record_user['State'],
                    'country' => $record_user['Country'],
                    'markup' => $markup_user, // Ensure this is a valid number
                ]);
            } 
            else 
            {
                // If product does not exist, create a new one
                User::create([
                    'mobile' => $record_user['Mobile '],
                    'name' => $record_user['Name'],
                    'email' => $email_user,
                    'password' => bcrypt($record_user['Mobile ']),
                    'otp' => null,
                    'expires_at' => null,
                    'address_line_1' => $record_user['Address Line 1'],
                    'address_line_2' => $record_user['Address Line 2'],
                    'city' => $record_user['City'],
                    'pincode' => $pincode_user,// Ensure this is a valid number
                    'gstin' => $record_user['GSTIN'],
                    'state' => $record_user['State'],
                    'country' => $record_user['Country'],
                    'markup' => $markup_user, // Ensure this is a valid number
                ]);
            }
        }   
        return response()->json(['message' => 'Users imported successfully'], 200);
    }
}
