<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananGaunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_gaun', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pemesanan');
            $table->date('mulai_sewa');
            $table->date('akhir_sewa');
            $table->string('nama');
            $table->longText('alamat');
            $table->longText('request');
            $table->string('telepon');
            $table->integer('total_pembayaran');
            $table->tinyInteger('status');
            $table->foreignId('users_id')->nullable()->constrained('users');
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
        Schema::dropIfExists('pemesanan_gaun');
    }
}
