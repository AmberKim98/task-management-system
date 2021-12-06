<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('task_id');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
            $table->string('task_title')->nullable(false);
            $table->string('description')->nullable(false);
            $table->integer('assigned_member_id')->default('0');
            $table->integer('estimate_hr')->nullable(false);
            $table->integer('actual_hr')->nullable();
            $table->integer('status')->nullable(false)->default('0');
            $table->dateTime('estimate_start_date')->nullable();
            $table->dateTime('estimate_finish_date')->nullable();
            $table->dateTime('actual_start_date')->nullable();
            $table->dateTime('actual_finish_date')->nullable();
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->nullable();    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
