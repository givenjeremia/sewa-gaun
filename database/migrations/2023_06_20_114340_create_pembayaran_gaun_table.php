<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranGaunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_gaun', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pembayaran');
            $table->integer('total_pembayaran');
            $table->integer('uang_muka');
            $table->integer('sisa_pembayaran');
            $table->string('metode_pembayaran');
            $table->tinyInteger('status_pembayaran');
            $table->foreignId('pemesanan_gaun_id')->nullable()->constrained('pemesanan_gaun');
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
        Schema::dropIfExists('pembayaran_gaun');
    }
}
