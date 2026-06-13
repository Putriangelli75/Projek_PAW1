<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking', function (Blueprint $table) {

            $table->id('id_booking');

            $table->string('kode_booking')->nullable();

            $table->foreignId('id_user');

            $table->foreignId('id_lapangan');

            $table->date('tanggal_booking');

            $table->time('jam_mulai');

            $table->integer('durasi');

            $table->decimal('total_bayar', 12, 2);

            $table->string('status')
                  ->default('pending');

            $table->string('bukti_pembayaran')
                  ->nullable();

            $table->string('metode_pembayaran')
                  ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};