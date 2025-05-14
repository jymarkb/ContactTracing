<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Zone;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=8491; $i < 8566; $i++) { 

            for ($j=1; $j < 8; $j++) { 
                $data=[
                    'zones_name' =>'Zone ' . $j ,
                    'barangays_id' => $i
                ];

                Zone::create($data);
            }
        }
    }
}
