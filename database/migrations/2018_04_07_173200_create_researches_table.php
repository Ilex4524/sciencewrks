<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->date('published_at');
            $table->decimal('size', 4, 2);
            $table->boolean('is_abroad')->default(false);
            $table->boolean('is_scopus')->default(false);
            $table->boolean('is_vak')->default(false);
            $table->unique(['name', 'published_at']);
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
        Schema::dropIfExists('researches');
    }
}
