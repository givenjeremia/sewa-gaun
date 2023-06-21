<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGambarPeriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('gambar_perias', function (Blueprint $table) {
        //     $table->id();
        //     $table->id();
        //     $table->longText('nama_file');
        //     $table->foreignId('gaun_id')->nullable()->constrained('gaun');
        //     $table->timestamps();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gambar_perias');
    }
}
