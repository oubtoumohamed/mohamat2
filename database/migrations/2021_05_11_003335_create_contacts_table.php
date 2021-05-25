<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable(); 
            $table->string('mobile')->nullable(); 
            $table->string('email')->nullable(); 
            $table->string('description')->nullable();
            $table->integer('contactcategorie_id')->unsigned()->nullable();
            $table->foreign('contactcategorie_id')
                    ->references('id')
                    ->on('contactcategories')
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
        Schema::dropIfExists('contacts');
    }
}
