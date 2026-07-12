<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kendaraan', function (Blueprint $table) {

            $table->id();

            $table->foreignId('pengendara_id')
                  ->constrained('pengendara')
                  ->cascadeOnDelete();

            $table->string('nomor_polisi')->unique();
            $table->string('merk');
            $table->string('jenis');
            $table->string('warna');
            $table->year('tahun');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};