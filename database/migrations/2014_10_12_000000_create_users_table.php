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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nim')->unique();
            $table->unsignedSmallInteger('angkatan')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->default(Hash::make('defaultpassword'));
            $table->string('phone_number')->nullable();
            $table->string('akun_github')->nullable();
            $table->string('akun_linkedin')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', ['admin', 'mahasiswa'])->default('mahasiswa');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
