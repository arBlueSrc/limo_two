<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('single_result', function($table) {
            $table->string('job')->after('major')->nullable();
            $table->string('gender')->after('job')->nullable();
            $table->string('degree')->after('job')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('single_result', function($table) {
            $table->dropColumn('job');
            $table->dropColumn('gender');
            $table->dropColumn('degree');
        });
    }
};
