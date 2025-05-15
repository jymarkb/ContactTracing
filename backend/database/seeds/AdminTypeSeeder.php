<?php

use Illuminate\Database\Seeder;
use App\Type;

class AdminTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['types_description'=>'Admin'],
            ['types_description'=>'Misu'],
            ['types_description'=>'Contact Tracer'],
            ['types_description'=>'Establishement']
        ];
        Type::insert($data);
    }
}
