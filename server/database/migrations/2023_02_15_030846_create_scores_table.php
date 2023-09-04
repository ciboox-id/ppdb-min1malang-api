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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->bigInteger('mandiri')->nullable();
            $table->bigInteger('umum')->nullable();
            $table->string('name_validator_umum')->nullable();

            $table->bigInteger('agama')->nullable();
            $table->string('name_validator_agama')->nullable();

            $table->bigInteger('uji_tahfidz')->nullable();
            $table->string('name_validator_tahfidz')->nullable();

            $table->bigInteger('prestasi')->nullable();
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
        Schema::dropIfExists('scores');
    }
};
