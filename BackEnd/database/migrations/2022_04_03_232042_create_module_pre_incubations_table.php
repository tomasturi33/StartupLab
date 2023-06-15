<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulePreIncubationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_pre_incubations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('edition_id')->unsigned();
            $table->Integer('order')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('activity_statement')->nullable();
            $table->string('slug');
            $table->integer('state');
            $table->timestamps();

            $table->foreign('edition_id')->references('id')->on('editions')
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
        Schema::dropIfExists('module_pre_incubations');
    }
}
