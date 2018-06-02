<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_employees', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('department')->unsigned()->nullable();
            $table->foreign('department')
            ->references('id')->on('departments')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('employee')->unsigned();
            $table->foreign('employee')
            ->references('id')->on('employees')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('emp_position')->unsigned()->nullable();
            $table->foreign('emp_position')
            ->references('id')->on('positions')
            ->onDelete('cascade')->onUpdate('cascade');
         
            $table->integer('emp_degree')->unsigned()->nullable();
            $table->foreign('emp_degree')
            ->references('id')->on('degrees')
            ->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('emp_title')->unsigned()->nullable();
            $table->foreign('emp_title')
            ->references('id')->on('titles')
            ->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('emp_type')->unsigned()->nullable();
            $table->foreign('emp_type')
            ->references('id')->on('staff_types')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->decimal('wage_rate', 4, 2)->nullable();

            $table->date('date_from')->nullable();

            $table->date('date_to')->nullable();

            $table->unique(['department', 'employee']);

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
        Schema::dropIfExists('department_employees');
    }
}
