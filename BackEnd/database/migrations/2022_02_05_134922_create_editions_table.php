<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->time('start_time', $precision = 0)->nullable();
            $table->date('finish_date')->nullable();
            $table->time('finish_time', $precision = 0)->nullable();
            $table->boolean('pre_incubation');
            $table->boolean('incubation');
            $table->boolean('pre_aceleration');
            $table->boolean('published');
            $table->longtext('terms_and_conditions')->nullable();
            $table->string('slug');
            $table->integer('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('editions');
    }
}
