<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Writer;
use App\Models\User;

class CsvController extends Controller
{
    public function downloadCsv()
    {
        // Your data source, replace this with your actual data retrieval logic
        $users = User::all();
        $data = [['Name', 'Email']];

    // Populate the data array with user information
        foreach ($users as $user) {
            $data[] = [$user->name, $user->email];
        }
       

        // Create a new CSV Writer instance
        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        // Insert the data into the CSV
        $csv->insertAll($data);

        // Set headers for CSV download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="data.csv"',
        ];

        // Create a response with the CSV content
        return response((string)$csv, 200, $headers);
    }
}