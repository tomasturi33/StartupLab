<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePillTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pill_teachers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pill_id')->unsigned();
            $table->string('academic_title')->nullable();
            $table->string('abbreviated_academic_title')->nullable();
            $table->string('name_teacher');
            $table->string('lastname_teacher');
            $table->string('email')->nullable();
            $table->string('linkedin')->nullable();
            $table->boolean('state');
            $table->timestamps();

            $table->foreign('pill_id')->references('id')->on('pills')
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
        Schema::dropIfExists('pill_teachers');
    }
}
