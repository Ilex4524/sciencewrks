<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_checks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('research')->unsigned();
            $table->foreign('research')
            ->references('id')->on('researches')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('checker')->unsigned();
            $table->foreign('checker')
            ->references('id')->on('admins')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('checked_at')->useCurrent();

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
        Schema::dropIfExists('research_checks');
    }
}
