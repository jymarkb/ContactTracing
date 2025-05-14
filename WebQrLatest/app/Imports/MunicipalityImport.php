<?php

namespace App\Imports;

use App\Municipality;
use Maatwebsite\Excel\Concerns\ToModel;

class MunicipalityImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Municipality([
            'municipalities_id'=> $row[0],
            'municipalities_name' => $row[1],
            'province_id' =>$row[2]
        ]);
    }
}
