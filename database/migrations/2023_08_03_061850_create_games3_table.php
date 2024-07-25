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
        Schema::create('games3', function (Blueprint $table) {
            $table->foreignId('level_id')->constrained('levels')->cascadeOnDelete();
            $table->id();
            $table -> string('name');
            $table -> Longtext('value1');
            $table -> string('value2');
        //    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games3');
    }
};
