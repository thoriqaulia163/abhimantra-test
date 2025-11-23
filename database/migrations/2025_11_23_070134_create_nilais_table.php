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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained(
                table:'siswas',
                indexName:'nilai_siswa_id'
            );
            // $table->unsignedBigInteger('siswa_id');
            // $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->integer("kelas");
            $table->string("mapel");
            $table->integer("nilai");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
