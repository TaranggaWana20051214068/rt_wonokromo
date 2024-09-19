<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk');
            $table->string('nik')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('status_dalam_keluarga')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->string('keterangan_tidak_aktif')->nullable();
            $table->string('dokumen_pendukung')->nullable();
            $table->enum('umur_kategori', ['Kanak-kanak', 'Remaja', 'Dewasa', 'Lansia']);
            $table->enum('status_kesejahteraan', ['Sejahtera', 'Pra-sejahtera', 'Rentan ekonomi', 'Penerima bantuan sosial']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk_tables');
    }
};
