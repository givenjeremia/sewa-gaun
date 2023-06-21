<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPemesananPeriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pemesanan_perias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perias_id')->nullable()->constrained('perias');
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
        Schema::dropIfExists('detail_pemesanan_perias');
    }
}
