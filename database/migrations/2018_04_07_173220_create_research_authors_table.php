<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_authors', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('research')->unsigned();
            $table->foreign('research')
            ->references('id')->on('researches')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('author')->unsigned();
            $table->foreign('author')
            ->references('id')->on('department_employees')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->decimal('bulk', 4, 2);

            $table->unique(['research', 'author']);

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
        Schema::dropIfExists('research_authors');
    }
}
