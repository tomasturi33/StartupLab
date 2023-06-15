<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeaNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idea_needs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('convocation_form_id')->unsigned()->nullable();
            $table->bigInteger('entrepreneurship_need_id')->unsigned()->nullable();
            $table->boolean('state');
            $table->timestamps();

            $table->foreign('convocation_form_id')->references('id')->on('convocation_forms')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('entrepreneurship_need_id')->references('id')->on('entrepreneurship_needs')
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
        Schema::dropIfExists('idea_needs');
    }
}
