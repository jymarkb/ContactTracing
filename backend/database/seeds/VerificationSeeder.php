<?php

use Illuminate\Database\Seeder;
use App\Verification;

class VerificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['verifications_name'=>'Verified'],
            ['verifications_name'=>'Not Verified']
        ];
        Verification::insert($data);
    }
}
