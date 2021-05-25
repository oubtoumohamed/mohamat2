<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('country')->nullable(); 
            $table->string('state')->nullable(); 
            $table->string('city')->nullable();
            $table->integer('courtcategorie_id')->unsigned()->nullable();
            $table->foreign('courtcategorie_id')
                    ->references('id')
                    ->on('courtcategories')
                    ->onDelete('set null');
            $table->string('location')->nullable(); 
            $table->string('name')->nullable(); 
            $table->integer('room_number')->nullable(); 
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
        Schema::dropIfExists('courts');
    }
}
