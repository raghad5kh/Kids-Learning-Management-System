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
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('record_id')->constrained('records')->cascadeOnDelete();
            $table -> string('email')->unique();
            $table -> string('password');
            $table -> string('owner');
            $table -> string('name');
            $table -> string('nickname')->nullable();
            $table -> Longtext('photo')->nullable();
            $table ->softDeletes();

            $table->rememberToken();
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
        Schema::dropIfExists('students');
    }
};
