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
        Schema::table('project_mahasiswa', function (Blueprint $table) {
            $table->boolean('hidden')->default(false)->after('gambar_4')->comment('Indicates if the project is hidden or not');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_mahasiswa', function (Blueprint $table) {
            $table->dropColumn('hidden');
        });
    }
};
