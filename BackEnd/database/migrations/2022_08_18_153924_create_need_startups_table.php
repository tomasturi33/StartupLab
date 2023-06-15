<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeedStartupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('need_startups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('entrepreneurship_id')->unsigned()->nullable();
            $table->bigInteger('entrepreneurship_need_id')->unsigned()->nullable();
            $table->boolean('state');
            $table->timestamps();

            $table->foreign('entrepreneurship_id')->references('id')->on('entrepreneurships')
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
        Schema::dropIfExists('need_startups');
    }
}
