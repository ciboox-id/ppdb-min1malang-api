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
        Schema::table('mothers', function (Blueprint $table) {
            $table->string('gelar_depan');
            $table->string('gelar_belakang');
            $table->string('status');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('pend_terakhir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mothers', function (Blueprint $table) {
            //
        });
    }
};
