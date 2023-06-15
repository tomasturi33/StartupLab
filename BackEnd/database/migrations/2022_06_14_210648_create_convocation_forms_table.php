<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvocationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocation_forms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('executive_summary')->nullable();
            $table->text('problem_detected')->nullable();
            $table->text('proposed_solution')->nullable();
            $table->text('products_services_you_offer')->nullable();
            $table->text('market')->nullable();
            $table->text('entrepreneurial_team')->nullable();
            $table->text('action_plan')->nullable();

            $table->bigInteger('entrepreneurship_stadia_id')->unsigned()->nullable();
            $table->bigInteger('development_degrees_id')->unsigned()->nullable();

            $table->bigInteger('vertical_works_id')->unsigned()->nullable();

            $table->string('entrepreneurship_needs')->nullable();
            $table->string('video')->nullable();

            $table->bigInteger('provincia_id')->unsigned()->nullable();
            $table->bigInteger('localidad_id')->unsigned()->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('edition_id')->unsigned()->nullable();

            $table->string('condition');            
            $table->boolean('is_sent');
            $table->boolean('state');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('edition_id')->references('id')->on('editions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('provincia_id')->references('id')->on('provincias')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('localidad_id')->references('id')->on('localidads')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('entrepreneurship_stadia_id')->references('id')->on('entrepreneurship_stadia')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('development_degrees_id')->references('id')->on('development_degrees')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('vertical_works_id')->references('id')->on('vertical_works')
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
        Schema::dropIfExists('convocation_forms');
    }
}
