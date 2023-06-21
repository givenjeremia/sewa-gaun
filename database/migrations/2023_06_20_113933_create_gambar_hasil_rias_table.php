<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGambarHasilRiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar_hasil_rias', function (Blueprint $table) {
            $table->id();
            $table->longText('nama_file');
            $table->foreignId('hasil_rias_id')->nullable()->constrained('hasil_rias');
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
        Schema::dropIfExists('gambar_hasil_rias');
    }
}
