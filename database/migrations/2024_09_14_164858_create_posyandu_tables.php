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
        Schema::create('posyandus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir');
            $table->string('kategori'); // kategori: bayi, balita, remaja, ibu hamil, lansia
            $table->string('alamat');
            $table->string('no_telepon')->nullable();
            $table->string('nama_ibu')->nullable(); // khusus untuk bayi dan balita
            $table->string('nama_ayah')->nullable(); // khusus untuk bayi dan balita
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posyandu_tables');
    }
};
