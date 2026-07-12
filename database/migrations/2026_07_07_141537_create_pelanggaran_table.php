<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggaran', function (Blueprint $table) {

            $table->id();

            $table->foreignId('petugas_id')
                  ->constrained('petugas')
                  ->cascadeOnDelete();

            $table->foreignId('kendaraan_id')
                  ->constrained('kendaraan')
                  ->cascadeOnDelete();

            $table->date('tanggal');
            $table->string('lokasi');
            $table->integer('total_denda')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggaran');
    }
};