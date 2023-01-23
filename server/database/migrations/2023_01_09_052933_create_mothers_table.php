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
        Schema::create('mothers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap_ibu')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->text('pekerjaan_ibu')->nullable();
            $table->text('nama_kantor_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('no_telp_ibu')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('mothers');
    }
};
