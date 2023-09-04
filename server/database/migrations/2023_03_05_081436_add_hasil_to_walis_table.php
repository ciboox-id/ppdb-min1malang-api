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
        Schema::table('walis', function (Blueprint $table) {
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota_kab')->nullable();
            $table->string("provinsi")->nullable();
            $table->string('kode_pos')->nullable();
            $table->bigInteger('nik_wali')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('walis', function (Blueprint $table) {
            //
        });
    }
};
