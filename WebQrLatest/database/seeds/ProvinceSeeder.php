<?php

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProvincesImport;
use Illuminate\Support\Facades\Storage;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // public_path('storage/address/province.xlsx');
        $file = public_path('address/province.xlsx');
        Excel::import(new ProvincesImport, $file);
    }
}
