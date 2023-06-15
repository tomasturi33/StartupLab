<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulePreIncubationTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_pre_incubation_tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('module_pre_incubation_id')->unsigned()->nullable();
            $table->bigInteger('entrepreneurship_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->text('message')->nullable();
            $table->string('task');
            $table->string('condition');
            $table->bigInteger('evaluator_id')->unsigned()->nullable();
            $table->text('devolution')->nullable();
            $table->boolean('state');
            $table->timestamps();

            $table->foreign('module_pre_incubation_id')->references('id')->on('module_pre_incubations')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('entrepreneurship_id')->references('id')->on('entrepreneurships')
                ->onDelete('cascade')
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
        Schema::dropIfExists('module_pre_incubation_tasks');
    }
}
