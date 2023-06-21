<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_review', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('bintang');
            $table->longText('review');
            $table->foreignId('gaun_id')->nullable()->constrained('gaun');
            $table->foreignId('perias_id')->nullable()->constrained('perias');
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
        Schema::dropIfExists('rating_review');
    }
}
