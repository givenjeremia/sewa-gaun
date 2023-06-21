<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananPeriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_perias', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pemesanan');
            $table->date('tanggal_event');
            $table->time('jam_event');
            $table->string('nama');
            $table->longText('alamat');
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
        Schema::dropIfExists('pemesanan_perias');
    }
}
