<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable(); 
            $table->integer('contact_id')->unsigned()->nullable();
            $table->foreign('contact_id')
                    ->references('id')
                    ->on('contacts')
                    ->onDelete('set null');
            $table->date('date')->nullable(); 
            $table->string('motive')->nullable(); 
            $table->string('note')->nullable(); 
            
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
        Schema::dropIfExists('appointments');
    }
}
