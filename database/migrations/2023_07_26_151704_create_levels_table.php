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
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('game_id')->constrained('games')->cascadeOnDelete();
            // $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete()-> nullable();
            $table->foreignId('main_level_id')->constrained('main_levels')->cascadeOnDelete();
            $table ->string('is_quiz');
           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levels');
    }
};
