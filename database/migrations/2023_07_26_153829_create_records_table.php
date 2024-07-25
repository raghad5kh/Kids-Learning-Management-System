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
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('main_level_id')->constrained('main_levels')->cascadeOnDelete();
            $table -> string('first_name')->nullable();
            $table -> string('last_name')->nullable();
            $table -> string('gender');
            $table -> date('birthdate');
            $table -> integer('phone');
            $table -> string('address');
            $table ->softDeletes();
            $table -> string('id_number',4)->unique();
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
        Schema::dropIfExists('records');
    }
};
