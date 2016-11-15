<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\TaskController;
use App\Models\Tasks;

class TaskStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update tasks from command';

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
     * @return mixed
     */
    public function handle()
    {
//        $task=new TaskController();
//        //$this->call( $task->getIndex());
//        $task->getIndex();
        $tasks=Tasks::get();
        //dd($tasks[1]->expiry);
        return view('task.index')->with([
            'tasks'  => $tasks,
        ]);
    }
}
