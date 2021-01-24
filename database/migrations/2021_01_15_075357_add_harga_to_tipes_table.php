<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHargaToTipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipes', function (Blueprint $table) {
            $table->integer('harga');
            $table->integer('stok');
            $table->text('note');
            $table->boolean('costum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipes', function (Blueprint $table) {
            //
        });
    }
}
