<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('module_pre_incubation_id')->unsigned();
            
            $table->Integer('order')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type_content');
            $table->string('content');
            $table->string('slug');
            $table->boolean('state');
            $table->timestamps();

            $table->foreign('module_pre_incubation_id')->references('id')->on('module_pre_incubations')
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
        Schema::dropIfExists('pills');
    }
}
