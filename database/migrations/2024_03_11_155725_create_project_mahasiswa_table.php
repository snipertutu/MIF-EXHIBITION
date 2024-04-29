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
        Schema::create('project_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aplikasi');
            $table->unsignedTinyInteger('semester');
            $table->unsignedSmallInteger('angkatan');
            $table->string('golongan');
            $table->string('ketua_kelompok')->nullable();
            $table->enum('kategori', ['Tugas Akhir', 'Workshop'])->nullable();
            $table->string('link_github')->nullable();
            $table->string('link_website')->nullable();
            $table->string('link_youtube')->nullable();
            $table->string('narasi')->nullable();
            $table->string('gambar_1')->nullable();
            $table->string('gambar_2')->nullable();
            $table->string('gambar_3')->nullable();
            $table->string('gambar_4')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_mahasiswa');
    }
};
