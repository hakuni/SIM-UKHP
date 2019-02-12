<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogPembelians extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_pembelians', function (Blueprint $table) {
            $table->increments('idLogPembelian');
            $table->integer('idAlatBahan');
            $table->timestamp('tglTrx');
            $table->integer('jumlah');
            $table->integer('harga');

            $table->string('createdBy');
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
        Schema::dropIfExists('log_pembelians');
    }
}
