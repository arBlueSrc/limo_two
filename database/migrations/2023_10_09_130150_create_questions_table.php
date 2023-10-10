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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->tinyInteger('type')->default('0');
            $table->string('option_1')->nullable()->default(null);
            $table->string('option_2')->nullable()->default(null);
            $table->string('option_3')->nullable()->default(null);
            $table->string('option_4')->nullable()->default(null);
            $table->integer('answer')->nullable()->default(null);
            $table->text('tashrihi_answer')->nullable()->default(null);
            $table->bigInteger('parent_azmoon');
            $table->integer('question_score')->nullable()->default(null);
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
        Schema::dropIfExists('questions');
    }
};
