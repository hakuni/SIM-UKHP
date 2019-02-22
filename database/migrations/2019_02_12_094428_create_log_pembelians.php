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
            $table->string('namaAlatBahan');
            $table->timestamp('tglTrx');
            $table->integer('jumlah');
            $table->integer('harga');

            //foreign key
            $table->foreign('namaAlatBahan')->references('namaAlatBahan')->on('mst_alat_bahans')->onDelete('cascade');

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
