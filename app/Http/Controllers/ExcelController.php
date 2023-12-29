<?php

namespace App\Http\Controllers;

use App\Models\YourModel; // Replace with your actual model
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataTableExport; // Create this export class

class ExcelController extends Controller
{
    public function export()
    {
        return Excel::download(new DataTableExport, 'data.xlsx');
    }
}