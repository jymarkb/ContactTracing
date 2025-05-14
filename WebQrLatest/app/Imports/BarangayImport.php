<?php

namespace App\Imports;

use App\Barangay;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangayImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Barangay([
            'barangays_id' => $row[0],
            'barangays_name' => $row[1],
            'municipalities_id' => $row[2]
        ]);
    }
}
