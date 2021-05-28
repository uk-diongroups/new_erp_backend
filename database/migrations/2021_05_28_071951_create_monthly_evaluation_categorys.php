<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyEvaluationCategorys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_evaluation_categorys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('monthly_evaluation_id')->nullable();
            $table->text('task')->nullable();
            $table->foreign('monthly_evaluation_id')
            ->references('id')
            ->on('monthly_evaluations')
            ->onDelete('cascade');
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
        Schema::dropIfExists('monthly_evaluation_categorys');
    }
}
