<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exports\OntimeTasksExport;
use Excel; 
use Carbon\Carbon;

class ontime_tasks_report extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:ontime_tasks_report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download on-time tasks report.';

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
        $today_date = Carbon::now()->format('Y-m-d h-i-s');
        $filename = 'ontime_tasks_report_'.$today_date.'.xlsx';
        Excel::store(new OntimeTasksExport, 'storage/reports/'.$filename);
    }
}
