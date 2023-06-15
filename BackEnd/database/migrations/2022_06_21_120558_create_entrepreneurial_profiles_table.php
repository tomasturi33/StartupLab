<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrepreneurialProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepreneurial_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('dni')->nullable();
            $table->bigInteger('gender_id')->unsigned()->nullable();
            $table->string('email');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('convocation_form_id')->unsigned()->nullable();
            $table->string('phone_number')->nullable();

            $table->string('country')->nullable();
            $table->string('other_country')->nullable();
            $table->bigInteger('provincia_id')->unsigned()->nullable();
            $table->bigInteger('localidad_id')->unsigned()->nullable();
            $table->string('legal_address')->nullable();

            $table->bigInteger('completed_studie_id')->unsigned()->nullable();
            $table->string('secundary_tertiary_institute')->nullable();
            $table->string('secundary_tertiary_career')->nullable();

            $table->string('university')->nullable();
            $table->bigInteger('academic_unit_id')->unsigned()->nullable();
            $table->bigInteger('career_id')->unsigned()->nullable();

            $table->string('other_university')->nullable();
            $table->string('other_career')->nullable();

            $table->boolean('posgrade')->nullable();
            $table->string('posgrade_institute')->nullable();
            $table->string('posgrade_career')->nullable();

            $table->string('occupation')->nullable();

            $table->string('researcher_workplace')->nullable();

            $table->string('conicet')->nullable();
            $table->string('conicet_membership')->nullable();

            $table->boolean('is_protectable')->nullable();
            $table->boolean('is_susceptible_protected')->nullable();
            $table->boolean('have_statement_results')->nullable();


            $table->text('previous_experience')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('cv')->nullable();

            $table->boolean('status')->nullable();

            $table->boolean('state')->nullable();

            $table->timestamps();

            $table->foreign('gender_id')->references('id')->on('genders')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('convocation_form_id')->references('id')->on('convocation_forms')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('provincia_id')->references('id')->on('provincias')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('localidad_id')->references('id')->on('localidads')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('completed_studie_id')->references('id')->on('completed_studies')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('academic_unit_id')->references('id')->on('academic_units')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('career_id')->references('id')->on('careers')
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
        Schema::dropIfExists('entrepreneurial_profiles');
    }
}
