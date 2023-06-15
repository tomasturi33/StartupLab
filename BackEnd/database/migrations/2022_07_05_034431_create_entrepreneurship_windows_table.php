<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrepreneurshipWindowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepreneurship_windows', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('executive_summary');
            $table->text('problem_detected');
            $table->text('proposed_solution');
            $table->text('market')->nullable();
            $table->text('strategic_alliance')->nullable();
            $table->text('entrepreneurial_team')->nullable();
            $table->text('contact')->nullable();

            $table->string('logo')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->string('video')->nullable();

            $table->string('degree_development')->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('edition_id')->unsigned()->nullable();
            $table->bigInteger('convocation_form_id')->unsigned()->nullable();

            $table->boolean('published');
            $table->string('slug');
            $table->boolean('state');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('edition_id')->references('id')->on('editions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
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
        Schema::dropIfExists('entrepreneurship_windows');
    }
}
