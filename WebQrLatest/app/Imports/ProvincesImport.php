<?php

namespace App\Imports;

use App\Province;
use Maatwebsite\Excel\Concerns\ToModel;

class ProvincesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Province([
            'province_id' => $row[0],
            'province_name' => $row[1]
        ]);
    }
}
