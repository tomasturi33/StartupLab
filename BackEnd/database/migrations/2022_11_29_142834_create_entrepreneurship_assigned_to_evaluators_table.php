<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrepreneurshipAssignedToEvaluatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepreneurship_assigned_to_evaluators', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('entrep_id')->unsigned(); //se acorto el nombre entrepreneurship_id porque daba un error sql
            $table->bigInteger('edition_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('entrep_id')->references('id')->on('entrepreneurships')
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
        Schema::dropIfExists('entrepreneurship_assigned_to_evaluators');
    }
}
