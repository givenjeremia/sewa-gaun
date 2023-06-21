<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranPeriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_perias', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pembayaran');
            $table->integer('total_pembayaran');
            $table->integer('dp');
            $table->integer('sisa_pembayaran');
            $table->string('metode_pembayaran');
            $table->tinyInteger('status_pembayaran');
            $table->foreignId('pemesanan_perias_id')->nullable()->constrained('pemesanan_perias');
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
        Schema::dropIfExists('pembayaran_perias');
    }
}
