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
        Schema::create('games_list', function (Blueprint $table) {
            $table->id();

          //  $table->rememberToken();
           // $table->string('name');
          //  $table -> Longtext('photo');
        //   $table->foreignId('level_id')->constrained('levels')->cascadeOnDelete();
        //   $table->foreignId('games1_id')->constrained('games1')->cascadeOnDelete();
        //   $table->foreignId('games2_id')->constrained('games2')->cascadeOnDelete();
        //   $table->foreignId('games3_id')->constrained('games3')->cascadeOnDelete();
        //   $table->foreignId('games4_id')->constrained('games4')->cascadeOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games_list');
    }
};
