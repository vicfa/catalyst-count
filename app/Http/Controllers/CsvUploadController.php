<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CsvData;
use Illuminate\Support\Facades\DB;

class CsvUploadController extends Controller
{
    public function showForm()
    {
        return view('csvupload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');

        // Process CSV file and insert data into the database
        $this->processCsvFile($file);

        return redirect()->route('upload.form')->with('success', 'CSV file uploaded and data stored successfully.');
    }

    private function processCsvFile($file)
    {
        // Read CSV file
        $csvData = array_map('str_getcsv', file($file));

        // Extract header
        $header = array_shift($csvData);

        $header = [
            'cid',
            'name',
            'domain',
            'year_founded',
            'industry',
            'size_range',
            'locality',
            'country',
            'linkedin_url',
            'current_employee_estimate',
            'total_employee_estimate',
        ];

        // Insert data into the database
        DB::table('CsvData')->insert(
            array_map(function ($row) use ($header) {
                return array_combine($header, $row);
            }, $csvData)
        );
    }

    public function processFilter(Request $request)
    {
        $query = CsvData::query();

        // Apply filters based on user input
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Add more conditions for other filters...

        // Execute the query and get the count
        $count = $query->count();

        return view('csvupload', compact('count'));
    }
}
