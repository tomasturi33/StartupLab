<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrepreneurshipInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepreneurship_invitations', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique();
            $table->bigInteger('entrepreneurial_profile_id')->unsigned()->nullable();
            $table->boolean('state');
            $table->timestamps();
            
            $table->foreign('entrepreneurial_profile_id')->references('id')->on('entrepreneurial_profiles')
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
        Schema::dropIfExists('entrepreneurship_invitations');
    }
}
