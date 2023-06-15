<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequireActivityToModulePreIncubationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('module_pre_incubations', function (Blueprint $table) {
            $table->boolean('require_activity')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('module_pre_incubations', function (Blueprint $table) {
            $table->dropColumn('require_activity');
        });
    }
}
