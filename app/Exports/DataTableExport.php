<?php

namespace App\Exports;

use App\Models\YourModel; // Replace with your actual model
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\User;

class DataTableExport implements FromCollection
{
    public function collection()
    {
        return User::all(); // Replace with your actual model query
    }
}
