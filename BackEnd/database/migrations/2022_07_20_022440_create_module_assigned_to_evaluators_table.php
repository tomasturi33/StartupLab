<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleAssignedToEvaluatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_assigned_to_evaluators', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('module_pre_incubation_id')->unsigned();
            $table->bigInteger('edition_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('module_pre_incubation_id')->references('id')->on('module_pre_incubations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('edition_id')->references('id')->on('editions')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_assigned_to_evaluators');
    }
}
