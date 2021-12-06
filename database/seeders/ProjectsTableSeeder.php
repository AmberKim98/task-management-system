<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = [
            [
                'project_name' => 'Box of Crayons',
                'language' => 'Java',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-9-24',
                'end_date' => '2021-10-24'
            ],
            [
                'project_name' => 'Debug Entity',
                'language' => 'Ruby',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-10-25',
                'end_date' => '2021-11-25'
            ],
            [
                'project_name' => 'Search Engine Bandits',
                'language' => 'Python',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-11-10',
                'end_date' => '2021-12-10'
            ],
            [
                'project_name' => 'Open Source Pundits',
                'language' => 'PHP',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-9-13',
                'end_date' => '2021-10-13'
            ],
            [
                'project_name' => 'Static Startup',
                'language' => 'HTML/CSS',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-10-2',
                'end_date' => '2021-11-2'
            ],
            [
                'project_name' => 'Hex Clan',
                'language' => 'C#',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-10-15',
                'end_date' => '2021-11-15'
            ],
            [
                'project_name' => 'Search Engine Bandits',
                'language' => 'PHP',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-9-3',
                'end_date' => '2021-10-3'
            ],
            [
                'project_name' => 'Code Change Group',
                'language' => 'PHP',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-11-23',
                'end_date' => '2021-12-23'
            ],
            [
                'project_name' => 'Java Dalia',
                'language' => 'PHP',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-9-17',
                'end_date' => '2021-10-17'
            ],
            [
                'project_name' => 'Impact Training',
                'language' => 'Python',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-9-4',
                'end_date' => '2021-10-4'
            ],
            [
                'project_name' => 'Switch and Swift',
                'language' => 'PHP',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-11-3',
                'end_date' => '2021-12-3'
            ],
            [
                'project_name' => 'Coding League',
                'language' => 'Ruby',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-9-13',
                'end_date' => '2021-10-13'
            ],
            [
                'project_name' => 'Excalibur Training',
                'language' => 'Python',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-10-5',
                'end_date' => '2021-11-5'
            ],
            [
                'project_name' => 'Linkage, Inc.',
                'language' => 'C#',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-9-6',
                'end_date' => '2021-10-6'
            ],
            [
                'project_name' => 'Enter Coding',
                'language' => 'Java',
                'description' => 'This project will develop a module offered to level 2 Undergraduate students and will seek to develop student’s skills',
                'start_date' => '2021-11-7',
                'end_date' => '2021-12-7'
            ]
        ];

        DB::table('projects') -> truncate();
        
        foreach($project as $value){
            DB::table('projects') -> insert([
                'project_name' => $value['project_name'],
                'language' => $value['language'],
                'description' => $value['description'],
                'start_date' => $value['start_date'],
                'end_date' => $value['end_date'],
                'created_at'=>Date('Y-m-d H:i:s'),
                'updated_at'=>null
            ]);
        }
    }
}
