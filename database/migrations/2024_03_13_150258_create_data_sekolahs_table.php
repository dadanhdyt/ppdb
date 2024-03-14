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
        Schema::create('data_sekolahs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUlid('pendaftaran_id')->constrained('pendaftarans', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('npsn');
            $table->string('nama');
            $table->string('kabupaten');
            $table->string('no_telp');
            $table->string('akreditasi');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_sekolahs');
    }
};
