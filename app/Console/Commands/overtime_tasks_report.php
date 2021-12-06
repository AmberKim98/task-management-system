<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;
use App\Models\Task;
use App\Exports\OvertimeTasksReport;

class overtime_tasks_report extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:overtime_tasks_report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download overtime tasks report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today_date = date('Y-m-d H-i-s');
        $filename = 'overtime_tasks_report_'.$today_date.'.xlsx';
        Excel::store(new OvertimeTasksReport, 'storage/reports/'.$filename);
    }
}
