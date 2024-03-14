<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_berkas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUlid('pendaftaran_id')->constrained('pendaftarans', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('nama');
            $table->text('keterangan');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_berkas');
    }
};
