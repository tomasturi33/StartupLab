<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationEntrepreneurshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitation_entrepreneurships', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('edition_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->string('url')->unique();
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
        Schema::dropIfExists('invitation_entrepreneurships');
    }
}
