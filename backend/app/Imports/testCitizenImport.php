<?php

namespace App\Imports;

use App\Citizen;
use Maatwebsite\Excel\Concerns\ToModel;

class testCitizenImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Citizen([
            'citizens_fname' => $row[0],
            'citizens_mname' => $row[1],
            'citizens_lname' => $row[2],
            'citizens_suffix' => $row[3],
            'citizens_bday' => $row[4],
            'citizens_gender' => $row[5],
            'citizens_profession' => $row[6],
            'citizens_mobile' => $row[7],
            'citizens_img_src' => $row[8],
            'citizens_qr_src' => $row[9],
            'province_id' => $row[10],
            'province_id_current' => $row[11],
            'municipalities_id' => $row[12],
            'municipalities_id_current' => $row[13],
            'barangays_id' => $row[14],
            'barangays_id_current' => $row[15],
            'zones_id' => $row[16],
            'zones_id_current' => $row[17],
            'citizen_add_address' => $row[18],
            'citizen_add_address_current' => $row[19],
            'verifications_id' => $row[20],
        ]);
    }
}
