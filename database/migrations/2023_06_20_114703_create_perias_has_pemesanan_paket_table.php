<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriasHasPemesananPaketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perias_has_pemesanan_paket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perias_id')->nullable()->constrained('perias');
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
        Schema::dropIfExists('perias_has_pemesanan_paket');
    }
}
