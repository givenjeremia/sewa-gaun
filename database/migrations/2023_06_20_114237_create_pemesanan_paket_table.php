<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananPaketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_paket', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pemesanan');
            $table->date('tanggal_event');
            $table->time('waktu_event');
            $table->string('nama');
            $table->longText('alamat');
            $table->string('telp');
            $table->integer('total_pembayaran');
            $table->tinyInteger('status_pembayaran');
            $table->foreignId('paket_id')->nullable()->constrained('paket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan_paket');
    }
}
