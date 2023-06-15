<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumStartupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_startups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('entrepreneurship_id')->unsigned()->nullable();
            $table->string('type');
            $table->text('description');
            $table->timestamps();

            $table->foreign('entrepreneurship_id')->references('id')->on('entrepreneurships')
                ->onDelete('cascade')
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
        Schema::dropIfExists('curriculum_startups');
    }
}
