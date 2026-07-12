<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pelanggaran', function (Blueprint $table) {

            $table->id();

            $table->foreignId('pelanggaran_id')
                  ->constrained('pelanggaran')
                  ->cascadeOnDelete();

            $table->foreignId('jenis_pelanggaran_id')
                  ->constrained('jenis_pelanggaran')
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pelanggaran');
    }
};