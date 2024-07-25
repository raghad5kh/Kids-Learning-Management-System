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
        Schema::create('games1', function (Blueprint $table) {
            $table->foreignId('level_id')->constrained('levels')->cascadeOnDelete();
            $table->id();
            $table->string('word')->nullable();
            $table->string('text')->nullable();
            $table->longText('image')->nullable();

         //   $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games1');
    }
};
