<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrepreneurshipNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepreneurship_notes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('entrepreneurship_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->text('note');
            $table->timestamps();

            $table->foreign('entrepreneurship_id')->references('id')->on('entrepreneurships')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('entrepreneurship_notes');
    }
}
