<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPemesananGaunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pemesanan_gaun', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gaun_id')->nullable()->constrained('gaun');
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
        Schema::dropIfExists('detail_pemesanan_gaun');
    }
}
