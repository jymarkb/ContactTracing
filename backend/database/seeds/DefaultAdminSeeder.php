<?php

use Illuminate\Database\Seeder;
use App\User;
class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $data = 
        [
            [
                'users_fname'=>'Jay Mark', 
                'users_mname'=>'Aureus', 
                'users_lname'=>'Borja' ,
                'users_suffix'=>null,
                'users_gender'=>'Male' ,
                'users_bday'=>'1999-05-20' ,
                'users_mobile'=>'09514292781', 
                'users_username'=>'panda', 
                'users_password'=>Hash::make('laravelproject'), 
                'users_profile'=>'default.jpg',
                'types_id'=>'1',
                'establishments_id' => null
            ],
            [
                'users_fname'=>'Another', 
                'users_mname'=>'Admin', 
                'users_lname'=>'Borja' ,
                'users_suffix'=>null,
                'users_gender'=>'Male' ,
                'users_bday'=>'1999-05-20' ,
                'users_mobile'=>'09514292782', 
                'users_username'=>'panda1', 
                'users_password'=>Hash::make('laravelproject'), 
                'users_profile'=>'default.jpg',
                'types_id'=>'2',
                'establishments_id' => null
            ],
            [
                'users_fname'=>'Another2', 
                'users_mname'=>'Admin2', 
                'users_lname'=>'Borja' ,
                'users_suffix'=>null,
                'users_gender'=>'Male' ,
                'users_bday'=>'1999-05-20' ,
                'users_mobile'=>'09514292783', 
                'users_username'=>'panda2', 
                'users_password'=>Hash::make('laravelproject'), 
                'users_profile'=>'default.jpg',
                'types_id'=>'3',
                'establishments_id' => null
            ]
        ];
        User::insert($data);


    }
}
