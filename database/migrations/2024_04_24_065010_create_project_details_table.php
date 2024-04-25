<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota');
            $table->unsignedBigInteger('project_mahasiswa_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('project_mahasiswa_id')
                  ->references('id')->on('project_mahasiswa')
                  ->onDelete('cascade');
            $table->foreign('anggota')
                  ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_details');
    }
}
