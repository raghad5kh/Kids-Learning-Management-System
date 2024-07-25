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
        Schema::create('game_result', function (Blueprint $table) {
            $table->id();
            $table ->integer('first_game')->nullable();
            $table ->integer('second_game')->nullable();
            $table ->integer('third_game')->nullable();
            $table ->integer('fourth_game')->nullable();
            $table ->integer('level_id');
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
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
        Schema::dropIfExists('game_result');
    }
};
