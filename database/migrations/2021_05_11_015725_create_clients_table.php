<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable(); 
            $table->string('mobile')->nullable(); 
            $table->string('email')->nullable(); 
            $table->boolean('gender')->nullable(); 
            $table->string('country')->nullable(); 
            $table->string('state')->nullable(); 
            $table->string('city')->nullable(); 
            $table->string('adress')->nullable(); 
            $table->string('description')->nullable();
            $table->integer('clientcategorie_id')->unsigned()->nullable();
            $table->foreign('clientcategorie_id')
                    ->references('id')
                    ->on('clientcategories')
                    ->onDelete('set null');
            
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
        Schema::dropIfExists('clients');
    }
}
