<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lapangan', function (Blueprint $table) {

            $table->id('id_lapangan');

            $table->string('nama_lapangan');

            $table->string('jenis_olahraga');

            $table->decimal('harga_per_jam', 12, 2);

            $table->string('gambar')->nullable();

            $table->enum(
                'status',
                ['aktif', 'nonaktif']
            )->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapangan');
    }
};