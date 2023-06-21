<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananPaketHasGaunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_paket_has_gaun', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gaun_id')->nullable()->constrained('gaun');
            $table->foreignId('pemesanan_paket_id')->nullable()->constrained('pemesanan_paket');
            $table->tinyInteger('pengembalian');
            $table->tinyInteger('pengambilan');
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
        Schema::dropIfExists('pemesanan_paket_has_gaun');
    }
}
