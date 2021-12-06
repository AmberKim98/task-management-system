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
                'assigned_member_id' => '1',
                'estimate_hr' => '8',
                'actual_hr' => null,
                'status' => '0',
                'estimate_start_date' => '2021-9-24',
                'estimate_finish_date' => '2021-9-24',
                'actual_start_date' => null,
                'actual_finish_date' => null,
            ],
            [
                'project_id' => '2',
                'task_title' => 'UT',
                'description' => 'Unit Test',
                'assigned_member_id' => '2',
                'estimate_hr' => '16',
                'actual_hr' => null,
                'status' => '1',
                'estimate_start_date' => '2021-10-25',
                'estimate_finish_date' => '2021-10-26',
                'actual_start_date' => '2021-10-25',
                'actual_finish_date' => null,
            ],
            [
                'project_id' => '3',
                'task_title' => 'Test',
                'description' => 'PC SP Test',
                'assigned_member_id' => '3',
                'estimate_hr' => '8',
                'actual_hr' => '16',
                'status' => '2',
                'estimate_start_date' => '2021-11-10',
                'estimate_finish_date' => '2021-11-10',
                'actual_start_date' => '2021-11-10',
                'actual_finish_date' => '2021-11-11'
            ],
            [
                'project_id' => '4',
                'task_title' => 'Review',
                'description' => 'Leader Review, OJT Review',
                'assigned_member_id' => '4',
                'estimate_hr' => '16',
                'actual_hr' => '18',
                'status' => '3',
                'estimate_start_date' => '2021-9-13',
                'estimate_finish_date' => '2021-9-14',
                'actual_start_date' => '2021-9-13',
                'actual_finish_date' => '2021-9-15'
            ],
            [
                'project_id' => '5',
                'task_title' => 'BugFix',
                'description' => 'Review Modification',
                'assigned_member_id' => '5',
                'estimate_hr' => '8',
                'actual_hr' => null,
                'status' => '0',
                'estimate_start_date' => '2021-10-2',
                'estimate_finish_date' => '2021-10-2',
                'actual_start_date' => null,
                'actual_finish_date' => null,
            ],
            [
                'project_id' => '6',
                'task_title' => 'BugFix (JP)',
                'description' => 'JP Review Modification',
                'assigned_member_id' => '6',
                'estimate_hr' => '8',
                'actual_hr' => null,
                'status' => '1',
                'estimate_start_date' => '2021-10-15',
                'estimate_finish_date' => '2021-10-15',
                'actual_start_date' => '2021-10-15',
                'actual_finish_date' => null,
            ],
            [
                'project_id' => '7',
                'task_title' => 'BugFix (JP)',
                'description' => 'JP Review Modification',
                'assigned_member_id' => '7',
                'estimate_hr' => '8',
                'actual_hr' => '8',
                'status' => '2',
                'estimate_start_date' => '2021-9-3',
                'estimate_finish_date' => '2021-9-3',
                'actual_start_date' => '2021-9-3',
                'actual_finish_date' => '2021-9-3'
            ],
            [
                'project_id' => '8',
                'task_title' => 'QA Confirm',
                'description' => 'QA Confirm',
                'assigned_member_id' => '8',
                'estimate_hr' => '8',
                'actual_hr' => '8',
                'status' => '3',
                'estimate_start_date' => '2021-11-23',
                'estimate_finish_date' => '2021-11-23',
                'actual_start_date' => '2021-11-23',
                'actual_finish_date' => '2021-11-23'
            ],
            [
                'project_id' => '9',
                'task_title' => 'Learn',
                'description' => 'Learn Code Flow',
                'assigned_member_id' => '9',
                'estimate_hr' => '16',
                'actual_hr' => null,
                'status' => '0',
                'estimate_start_date' => '2021-9-17',
                'estimate_finish_date' => '2021-9-18',
                'actual_start_date' => null,
                'actual_finish_date' => null,
            ],
            [
                'project_id' => '10',
                'task_title' => 'Support',
                'description' => 'Leader Support',
                'assigned_member_id' => '10',
                'estimate_hr' => '8',
                'actual_hr' => null,
                'status' => '1',
                'estimate_start_date' => '2021-9-4',
                'estimate_finish_date' => '2021-9-4',
                'actual_start_date' => '2021-9-4',
                'actual_finish_date' => null,
            ],
            [
                'project_id' => '11',
                'task_title' => 'Meeting',
                'description' => 'Project Meeting',
                'assigned_member_id' => '7',
                'estimate_hr' => '3',
                'actual_hr' => '3',
                'status' => '2',
                'estimate_start_date' => '2021-11-3',
                'estimate_finish_date' => '2021-11-3',
                'actual_start_date' => '2021-11-3',
                'actual_finish_date' => '2021-11-3'
            ],
            [
                'project_id' => '12',
                'task_title' => 'Doc',
                'description' => 'Create Project Requirements Doc',
                'assigned_member_id' => '1',
                'estimate_hr' => '3',
                'actual_hr' => '8',
                'status' => '3',
                'estimate_start_date' => '2021-9-13',
                'estimate_finish_date' => '2021-9-13',
                'actual_start_date' => '2021-9-13',
                'actual_finish_date' => '2021-9-13'
            ],
            [
                'project_id' => '13',
                'task_title' => 'Manage',
                'description' => 'Manage Project Timelinet',
                'assigned_member_id' => '2',
                'estimate_hr' => '3',
                'actual_hr' => null,
                'status'=>'0',
                'estimate_start_date' => '2021-10-5',
                'estimate_finish_date' => '2021-10-5',
                'actual_start_date' => null,
                'actual_finish_date' => null,
            ],
            [
                'project_id' => '14',
                'task_title' => 'Other',
                'description' => 'PC delay time',
                'assigned_member_id' => '3',
                'estimate_hr' => '3',
                'actual_hr' => null,
                'status' => '1',
                'estimate_start_date' => '2021-11-30',
                'estimate_finish_date' => '2021-11-30',
                'actual_start_date' => '2021-11-30',
                'actual_finish_date' => null,
            ],
            [
                'project_id' => '15',
                'task_title' => 'Env',
                'description' => 'Environment Setting',
                'assigned_member_id' => '4',
                'estimate_hr' => '3',
                'actual_hr' => '3',
                'status' => '2',
                'estimate_start_date' => '2021-11-7',
                'estimate_finish_date' => '2021-11-7',
                'actual_start_date' => '2021-11-7',
                'actual_finish_date' => '2021-11-7'
            ]
        ];

        DB::table('tasks') -> truncate();

        foreach($task as $value){
            DB::table('tasks') -> insert([
                'project_id' => $value['project_id'],
                'task_title' => $value['task_title'],
                'description' => $value['description'],
                'assigned_member_id' => $value['assigned_member_id'],
                'estimate_hr' => $value['estimate_hr'],
                'actual_hr' => $value['actual_hr'],
                'status' => $value['status'],
                'estimate_start_date' => $value['estimate_start_date'],
                'estimate_finish_date' => $value['estimate_finish_date'],
                'actual_start_date' => $value['actual_start_date'],
                'actual_finish_date' => $value['actual_finish_date'],
                'created_at'=>Date('Y-m-d H:i:s'),
                'updated_at'=>null
            ]);
        }
    }
}
