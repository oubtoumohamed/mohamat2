<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');

            $table->string('name')->nullable(); 
            $table->integer('case_id')->unsigned()->nullable();
            $table->foreign('case_id')
                    ->references('id')
                    ->on('cases')
                    ->onDelete('set null');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
            $table->string('priority')->nullable();
            $table->integer('stage_id')->unsigned()->nullable();
            $table->foreign('stage_id')
                    ->references('id')
                    ->on('stages')
                    ->onDelete('set null');
            $table->date('date')->nullable(); 
            $table->string('description')->nullable(); 
            
            $table->timestamps();
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
