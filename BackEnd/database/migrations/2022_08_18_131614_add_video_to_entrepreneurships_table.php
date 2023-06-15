<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoToEntrepreneurshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrepreneurships', function (Blueprint $table) {
            $table->string('video')->nullable()->after('vertical_works_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrepreneurships', function (Blueprint $table) {
            $table->dropColumn('video');
        });
    }
}
