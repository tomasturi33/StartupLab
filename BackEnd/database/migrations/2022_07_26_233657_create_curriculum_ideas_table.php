<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_ideas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('convocation_form_id')->unsigned()->nullable();
            $table->string('type');
            $table->text('description');
            $table->timestamps();

            $table->foreign('convocation_form_id')->references('id')->on('convocation_forms')
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
        Schema::dropIfExists('curriculum_ideas');
    }
}
