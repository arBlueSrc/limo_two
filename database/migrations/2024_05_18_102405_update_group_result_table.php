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
        Schema::table('group_result', function (Blueprint $table) {
            $table->string('forth_name')->after('third_phone')->nullable();
            $table->string('forth_phone')->after('forth_name')->nullable();
            $table->string('fifth_name')->after('forth_phone')->nullable();
            $table->string('fifth_phone')->after('fifth_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_result', function (Blueprint $table) {
            $table->dropColumn([
                'forth_name',
                'forth_phone',
                'fifth_name',
                'fifth_phone'
            ]);
        });
    }
};
