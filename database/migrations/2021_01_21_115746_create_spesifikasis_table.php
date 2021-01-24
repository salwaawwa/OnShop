<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spesifikasis', function (Blueprint $table) {
            $table->id();
            $table->integer('pesanans_id');
            $table->integer('pesanan_details_id');
            $table->integer('cathards_id');
            $table->integer('kapasitas_id');
            $table->string('invoice_number');
            $table->integer('jumlah_harga');
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
        Schema::dropIfExists('spesifikasis');
    }
}
