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
        Schema::create('fathers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap_ayah')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->text('pekerjaan_ayah')->nullable();
            $table->text('nama_kantor_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('no_telp')->nullable();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('fathers');
    }
};
