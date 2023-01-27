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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nisn')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('alamat_siswa')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('anak_ke')->nullable();
            $table->enum('gol_darah', ['A', 'B', 'AB', 'O'])->nullable();
            $table->string('foto_akte')->nullable();
            $table->string('foto_siswa')->nullable();
            $table->enum('role', ['admin', 'siswa'])->default('siswa');
            $table->enum('jalur', ['reguler', 'prestasi', 'afirmasi', 'tahfidz'])->nullable();
            $table->boolean('lolos')->default(false);
            $table->boolean('is_verif')->default(false);
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
        Schema::dropIfExists('users');
    }
};
