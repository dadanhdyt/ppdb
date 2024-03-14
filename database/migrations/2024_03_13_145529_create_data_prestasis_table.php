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
        Schema::create('data_prestasis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pendaftaran_id')->constrained('pendaftarans', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('nama');
            $table->year('tahun');
            $table->string('jenis_perlombaan');
            $table->string('lingkup');
            $table->string('perinkat');
            $table->string('file_sertifikat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_prestasis');
    }
};
