<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGambarPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->longText('nama_file');
            $table->foreignId('pembayaran_gaun_id')->nullable()->constrained('pembayaran_gaun');
            $table->foreignId('pembayaran_perias_id')->nullable()->constrained('pembayaran_perias');
            $table->foreignId('pemesanan_paket_id')->nullable()->constrained('pemesanan_paket');
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
        Schema::dropIfExists('gambar_pembayaran');
    }
}
