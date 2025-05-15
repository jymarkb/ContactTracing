<?php

use Illuminate\Database\Seeder;
use App\Establishment;
use App\User;
use App\Symptoms;
use App\Tag_Description;
use App\Monitor_Type;
use App\Scan;
use App\Facility;


class testInput extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $esData = [
            [
                'establishments_name' => 'company name',
                'establishments_permit' => '1234',
                'zones_id' => '25',
                'barangays_id' => '8494',
                'establishments_add_address' => '1st Floor Door #312'
            ],
            [
                'establishments_name' => 'company name1',
                'establishments_permit' => '1235',
                'zones_id' => '362',
                'barangays_id' => '8542',
                'establishments_add_address' => '2nd Floor Building Name'
            ]
        ];
        Establishment::insert($esData);
        $userData = [
            [
                'users_fname' => 'jay markkk',
                'users_mname' => 'aureus',
                'users_lname' => 'borja',
                'users_suffix' => 'II',
                'users_gender' => 'Male',
                'users_bday' => '1996-01-01',
                'users_mobile' => '09514292787',
                'users_username' => null,
                'users_password' => null,
                'users_profile'=>null,
                'types_id' => '4',
                'establishments_id' =>'1'
            ],
            [
                'users_fname' => 'First',
                'users_mname' => 'Middle',
                'users_lname' => 'Last',
                'users_suffix' => 'SR',
                'users_gender' => 'Male',
                'users_bday' => '1956-12-25',
                'users_mobile' => '09514292785',
                'users_username' => null,
                'users_password' => null,
                'users_profile'=>null,
                'types_id' => '4',
                'establishments_id' =>'2'
            ]
        ];
        User::insert($userData);
        $symptomData = [
            ['symptoms_description' => 'fever'],
            ['symptoms_description' => 'dry cough'],
            ['symptoms_description' => 'aches and pains'],
            ['symptoms_description' => 'sore throat'],
            ['symptoms_description' => 'diarrhoea'],
            ['symptoms_description' => 'conjunctivitis'],
            ['symptoms_description' => 'headache'],
            ['symptoms_description' => 'loss of taste or smell'],
            ['symptoms_description' => 'a rash on skin, or discolouration of fingers or toes'],
            ['symptoms_description' => 'difficulty breathing or shortness of breath'],
            ['symptoms_description' => 'chest pain or pressure'],
            ['symptoms_description' => 'loss of speech or movement'],
        ];
        Symptoms::insert($symptomData);

        $tag_desc_Data = [
            ['tag_desc_name' => 'Unblock'],
            ['tag_desc_name' => 'Block'],
            ['tag_desc_name' => 'Local Stranded Individual'],
            ['tag_desc_name' => 'Returning Overseas Filipinos'],
            ['tag_desc_name' => 'Release'],
            ['tag_desc_name' => 'Positive'],
            ['tag_desc_name' => 'Negative'],
            ['tag_desc_name' => 'Contact Person'],
        ];
        Tag_Description::insert($tag_desc_Data);
    
        $monitor_type_data = [
            ['monitor_types_name' => "Asymptomatic"],
            ['monitor_types_name' => "Symptomatic"],
            ['monitor_types_name' => "Recovered"],
            ['monitor_types_name' => "Died"],
        ];
        Monitor_Type::insert($monitor_type_data);


        $scanData = [
                        [
                            "scans_temperature" => "36.9",
                            "scans_timein" => "2021-02-07 17:05:32",
                            "scans_timeout" => "2021-02-07 17:30:22",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:07:17",
                            "citizens_id" => "1",
                            "establishments_id" => "1"
                        ],
                        [
                            "scans_temperature" => "36.1",
                            "scans_timein" => "2021-02-07 17:07:40",
                            "scans_timeout" => "2021-02-07 17:45:26",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:07:17",
                            "citizens_id" => "2",
                            "establishments_id" => "1"
                        ],
                        [
                            "scans_temperature" => "36.2",
                            "scans_timein" => "2021-02-07 17:10:48",
                            "scans_timeout" => "2021-02-07 17:47:30",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:07:17",
                            "citizens_id" => "3",
                            "establishments_id" => "1"
                        ],
                        [
                            "scans_temperature" => "36.4",
                            "scans_timein" => "2021-02-07 17:15:57",
                            "scans_timeout" => "2021-02-07 17:50:34",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:07:17",
                            "citizens_id" => "4",
                            "establishments_id" => "1"
                        ],
                        [
                            "scans_temperature" => "36.5",
                            "scans_timein" => "2021-02-07 17:30:04",
                            "scans_timeout" => "2021-02-07 17:55:41",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:07:18",
                            "citizens_id" => "5",
                            "establishments_id" => "1"
                        ],
                        [
                            "scans_temperature" => "36.3",
                            "scans_timein" => "2021-02-07 17:45:15",
                            "scans_timeout" => "2021-02-07 18:10:47",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:07:18",
                            "citizens_id" => "6",
                            "establishments_id" => "1"
                        ],
                        [
                            "scans_temperature" => "36.4",
                            "scans_timein" => "2021-02-07 17:56:26",
                            "scans_timeout" => "2021-02-07 18:30:10",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:09:37",
                            "citizens_id" => "7",
                            "establishments_id" => "1"
                        ],
                        [
                            "scans_temperature" => "36.2",
                            "scans_timein" => "2021-02-07 17:57:51",
                            "scans_timeout" => "2021-02-07 18:25:16",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:09:38",
                            "citizens_id" => "8",
                            "establishments_id" => "1"
                        ],
                        [
                            "scans_temperature" => "35.9",
                            "scans_timein" => "2021-02-07 18:05:04",
                            "scans_timeout" => "2021-02-07 18:36:22",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:09:38",
                            "citizens_id" => "9",
                            "establishments_id" => "1"
                        ],
                        [
                            "scans_temperature" => "37.0",
                            "scans_timein" => "2021-02-07 17:45:33",
                            "scans_timeout" => "2021-02-07 18:30:28",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:18:42",
                            "citizens_id" => "1",
                            "establishments_id" => "2"
                        ],
                        [
                            "scans_temperature" => "36.2",
                            "scans_timein" => "2021-02-07 17:48:43",
                            "scans_timeout" => "2021-02-07 18:15:15",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:18:43",
                            "citizens_id" => "10",
                            "establishments_id" => "2"
                        ],
                        [
                            "scans_temperature" => "36.7",
                            "scans_timein" => "2021-02-07 17:56:53",
                            "scans_timeout" => "2021-02-07 18:30:08",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:18:43",
                            "citizens_id" => "11",
                            "establishments_id" => "2"
                        ],
                        [
                            "scans_temperature" => "36.5",
                            "scans_timein" => "2021-02-07 18:00:03",
                            "scans_timeout" => "2021-02-07 18:30:22",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:18:43",
                            "citizens_id" => "12",
                            "establishments_id" => "2"
                        ],
                        [
                            "scans_temperature" => "36.3",
                            "scans_timein" => "2021-02-07 18:05:13",
                            "scans_timeout" => "2021-02-07 18:36:46",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:18:43",
                            "citizens_id" => "13",
                            "establishments_id" => "2"
                        ],
                        [
                            "scans_temperature" => "36.1",
                            "scans_timein" => "2021-02-07 18:20:23",
                            "scans_timeout" => "2021-02-07 18:48:40",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:18:44",
                            "citizens_id" => "14",
                            "establishments_id" => "2"
                        ],
                        [
                            "scans_temperature" => "36.2",
                            "scans_timein" => "2021-02-07 18:21:41",
                            "scans_timeout" => "2021-02-07 18:56:05",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:18:44",
                            "citizens_id" => "16",
                            "establishments_id" => "2"
                        ],
                        [
                            "scans_temperature" => "36.1",
                            "scans_timein" => "2021-02-07 18:30:51",
                            "scans_timeout" => "2021-02-07 18:57:11",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:18:44",
                            "citizens_id" => "17",
                            "establishments_id" => "2"
                        ],
                        [
                            "scans_temperature" => "36.1",
                            "scans_timein" => "2021-02-07 19:00:01",
                            "scans_timeout" => "2021-02-07 19:30:18",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:18:44",
                            "citizens_id" => "18",
                            "establishments_id" => "2"
                        ],
                        [
                            "scans_temperature" => "36.2",
                            "scans_timein" => "2021-02-07 19:01:59",
                            "scans_timeout" => "2021-02-07 19:36:32",
                            "scans_status" => "server",
                            "scans_timeupdate" => "2021-02-07 17:18:44",
                            "citizens_id" => "15",
                            "establishments_id" => "2"
                        ]
                
        ];
        Scan::insert($scanData);

        $facility_data = [
            ['facilities_desc' => 'Home'],
            ['facilities_desc' => 'Facility 1'],
            ['facilities_desc' => 'Facility 2'],
            ['facilities_desc' => 'Facility 3'],
        ];
        Facility::insert($facility_data);

    }
}
