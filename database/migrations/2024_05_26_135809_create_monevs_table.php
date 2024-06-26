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
        Schema::create('monevs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agenda_id');
            $table->string('perihal')->nullable();
            $table->date('tgl_rapat')->nullable();
            $table->time('pukul_mulai')->nullable();
            $table->time('pukul_selesai')->nullable();
            $table->string('tempat')->nullable();
            $table->string('file_monev')->nullable();
            $table->string('file_absen')->nullable();
            $table->string('notulen_rapat')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monevs');
    }
};
