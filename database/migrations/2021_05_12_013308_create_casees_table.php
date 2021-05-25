<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casees', function (Blueprint $table) {
            $table->increments('id');

            $table->string('number')->nullable(); 
            $table->string('filenumber')->nullable(); 
            $table->string('acts')->nullable(); 

            $table->integer('plaintiff')->unsigned()->nullable();
            $table->foreign('plaintiff')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('set null');

            $table->integer('accuesed')->unsigned()->nullable();
            $table->foreign('accuesed')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('set null');

            $table->integer('behalfof')->unsigned()->nullable();
            $table->foreign('behalfof')
                    ->references('id')
                    ->on('clientcategories')
                    ->onDelete('set null');

            $table->integer('court_id')->unsigned()->nullable();
            $table->foreign('court_id')
                    ->references('id')
                    ->on('courts')
                    ->onDelete('set null');

            $table->integer('categorie_id')->unsigned()->nullable();
            $table->foreign('categorie_id')
                    ->references('id')
                    ->on('casecategories')
                    ->onDelete('set null');

            $table->string('refname')->nullable(); 
            $table->string('refmobile')->nullable(); 

            $table->integer('lawyer_id')->unsigned()->nullable();
            $table->foreign('lawyer_id')
                    ->references('id')
                    ->on('lawyers')
                    ->onDelete('set null');

            $table->integer('stage_id')->unsigned()->nullable();
            $table->foreign('stage_id')
                    ->references('id')
                    ->on('stages')
                    ->onDelete('set null');

            $table->date('receiving_date')->nullable(); 
            $table->date('filing_date')->nullable(); 
            $table->date('hearing_date')->nullable(); 
            $table->date('judgement_date')->nullable(); 
            $table->string('description')->nullable(); 
            
            $table->integer('media_id')->unsigned()->nullable();
            $table->foreign('media_id')
                    ->references('id')
                    ->on('media')
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
        Schema::dropIfExists('casees');
    }
}
