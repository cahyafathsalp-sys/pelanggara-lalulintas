<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pelanggaran', function (Blueprint $table) {
            // tambahkan pengendara_id bila belum ada
            if (!Schema::hasColumn('pelanggaran', 'pengendara_id')) {
                $table->foreignId('pengendara_id')
                    ->nullable()
                    ->constrained('pengendara')
                    ->cascadeOnDelete();
            }

            // tambahkan keterangan bila belum ada
            if (!Schema::hasColumn('pelanggaran', 'keterangan')) {
                $table->text('keterangan')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pelanggaran', function (Blueprint $table) {
            if (Schema::hasColumn('pelanggaran', 'pengendara_id')) {
                // nama constraint berbeda antar versi; drop foreign dengan pencarian otomatis biasanya aman,
                // tapi di sini kita gunakan dropIfExists melalui try/catch yang defensif.
                try {
                    $table->dropForeign(['pengendara_id']);
                } catch (\Throwable $e) {
                    // noop
                }
                $table->dropColumn('pengendara_id');
            }

            if (Schema::hasColumn('pelanggaran', 'keterangan')) {
                $table->dropColumn('keterangan');
            }
        });
    }
};

