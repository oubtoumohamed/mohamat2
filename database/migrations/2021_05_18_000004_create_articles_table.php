<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('titre');
            $table->text('contenu');
            $table->integer('auteur')->unsigned()->nullable();
            $table->foreign('auteur')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
            $table->integer('categorie')->unsigned()->nullable();
            $table->foreign('categorie')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('set null');
            $table->string('lien');
            $table->string('info')->nullable();
            $table->integer('image')->unsigned()->nullable();
            $table->foreign('image')
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
        Schema::dropIfExists('articles');
    }
}
