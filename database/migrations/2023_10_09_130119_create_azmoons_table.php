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
        Schema::create('azmoons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('negative_point')->default('0');
            $table->tinyInteger('randomic')->default('0');
            $table->integer('randomic_number')->default('0');
            $table->dateTime('start_time')->nullable()->default(null);
            $table->dateTime('end_time')->nullable()->default(null);
            $table->string('shamsi')->nullable()->default(null);
            $table->string('start_hour')->nullable()->default(null);
            $table->string('end_hour')->nullable()->default(null);
            $table->string('duration');
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
        Schema::dropIfExists('azmoons');
    }
};
