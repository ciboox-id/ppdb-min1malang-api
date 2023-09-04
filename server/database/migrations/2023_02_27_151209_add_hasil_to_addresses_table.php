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
        Schema::table('addresses', function (Blueprint $table) {
            $table->enum('status_tempat', ['rumah sendiri', 'rumah orang tua', 'sewa/kontrak', 'asrama', 'lainnya'])->nullable();
            $table->string("rt")->nullable();
            $table->string("rw")->nullable();
            $table->string("provinsi")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            //
        });
    }
};
