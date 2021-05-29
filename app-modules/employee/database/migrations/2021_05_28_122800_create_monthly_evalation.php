<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyEvalation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->text('key_result_area')->nullable();
            $table->date('month_of_evaluation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('monthly_evaluation_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('monthly_evaluation_id')->nullable();
            $table->foreign('monthly_evaluation_id')->references('id')->on('monthly_evaluations')->onUpdate('cascade')->onDelete('cascade');
            $table->text('task')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('monthly_evaluation_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->nullable();
            $table->integer('hr_id')->nullable();
            $table->date('month_of_evaluation')->nullable();
            $table->text('manager_comment')->nullable();
            $table->text('hr_comment')->nullable();
            $table->boolean('isEmployeeAccept')->default(0);
            $table->boolean('isHrAccept')->default(0);
            $table->double('total_mark')->nullable();
            $table->timestamps();
            $table->softDeletes();    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_evaluations');
        Schema::dropIfExists('monthly_evaluation_categories');
    }
}
