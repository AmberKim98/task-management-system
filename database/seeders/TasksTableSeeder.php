<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task = [
            [
                'project_id' => '1',
                'task_title' => 'CD',
                'description' => 'Implement',
                'estimate_hr' => '8',
                'estimate_start_date' => '2021-9-24',
                'estimate_finish_date' => '2021-9-24'
            ],
            [
                'project_id' => '2',
                'task_title' => 'UT',
                'description' => 'Unit Test',
                'estimate_hr' => '8',
                'estimate_start_date' => '2021-10-25',
                'estimate_finish_date' => '2021-10-25'
            ],
            [
                'project_id' => '3',
                'task_title' => 'Test',
                'description' => 'PC SP Test',
                'estimate_hr' => '8',
                'estimate_start_date' => '2021-11-10',
                'estimate_finish_date' => '2021-11-10'
            ],
            [
                'project_id' => '4',
                'task_title' => 'Review',
                'description' => 'Leader Review, OJT Review',
                'estimate_hr' => '8',
                'estimate_start_date' => '2021-9-13',
                'estimate_finish_date' => '2021-9-13'
            ],
            [
                'project_id' => '5',
                'task_title' => 'BugFix',
                'description' => 'Review Modification',
                'estimate_hr' => '8',
                'estimate_start_date' => '2021-10-2',
                'estimate_finish_date' => '2021-10-2'
            ],
            [
                'project_id' => '6',
                'task_title' => 'BugFix (JP)',
                'description' => 'JP Review Modification',
                'estimate_hr' => '8',
                'estimate_start_date' => '2021-10-15',
                'estimate_finish_date' => '2021-10-15'
            ],
            [
                'project_id' => '7',
                'task_title' => 'BugFix (JP)',
                'description' => 'JP Review Modification',
                'estimate_hr' => '8',
                'estimate_start_date' => '2021-9-3',
                'estimate_finish_date' => '2021-9-3'
            ],
            [
                'project_id' => '8',
                'task_title' => 'QA Confirm',
                'description' => 'QA Confirm',
                'estimate_hr' => '8',
                'estimate_start_date' => '2021-11-23',
                'estimate_finish_date' => '2021-11-23'
            ],
            [
                'project_id' => '9',
                'task_title' => 'Learn',
                'description' => 'Learn Code Flow',
                'estimate_hr' => '8',
                'estimate_start_date' => '2021-9-17',
                'estimate_finish_date' => '2021-9-17'
            ],
            [
                'project_id' => '10',
                'task_title' => 'Support',
                'description' => 'Leader Support',
                'estimate_hr' => '8',
                'estimate_start_date' => '2021-9-4',
                'estimate_finish_date' => '2021-9-4'
            ],
            [
                'project_id' => '11',
                'task_title' => 'Meeting',
                'description' => 'Project Meeting',
                'estimate_hr' => '3',
                'estimate_start_date' => '2021-11-3',
                'estimate_finish_date' => '2021-11-3'
            ],
            [
                'project_id' => '12',
                'task_title' => 'Doc',
                'description' => 'Create Project Requirements Doc',
                'estimate_hr' => '3',
                'estimate_start_date' => '2021-9-13',
                'estimate_finish_date' => '2021-9-13'
            ],
            [
                'project_id' => '13',
                'task_title' => 'Manage',
                'description' => 'Manage Project Timelinet',
                'estimate_hr' => '3',
                'estimate_start_date' => '2021-10-5',
                'estimate_finish_date' => '2021-10-5'
            ],
            [
                'project_id' => '14',
                'task_title' => 'Other',
                'description' => 'PC delay time',
                'estimate_hr' => '3',
                'estimate_start_date' => '2021-9-6',
                'estimate_finish_date' => '2021-9-6'
            ],
            [
                'project_id' => '15',
                'task_title' => 'Env',
                'description' => 'Environment Setting',
                'estimate_hr' => '3',
                'estimate_start_date' => '2021-11-7',
                'estimate_finish_date' => '2021-11-7'
            ]
        ];

        DB::table('tasks') -> truncate();

        foreach($task as $value){
            DB::table('tasks') -> insert([
                'project_id' => $value['project_id'],
                'task_title' => $value['task_title'],
                'description' => $value['description'],
                'estimate_hr' => $value['estimate_hr'],
                'actual_hr' => Date('H'),
                'estimate_start_date' => $value['estimate_start_date'],
                'estimate_finish_date' => $value['estimate_finish_date'],
                'actual_start_date' => Date('Y-m-d H:i:s'),
                'actual_finish_date' => Date('Y-m-d H:i:s'),
                'created_at'=>Date('Y-m-d H:i:s'),
                'updated_at'=>null
            ]);
        }
    }
}
