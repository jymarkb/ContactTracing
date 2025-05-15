<?php

use Illuminate\Database\Seeder;
use App\Imports\testCitizenImport;
use Maatwebsite\Excel\Facades\Excel;

class testCitizen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = database_path('seeds\address\testCitizen.xlsx');
        Excel::import(new testCitizenImport, $file);
    }
}
