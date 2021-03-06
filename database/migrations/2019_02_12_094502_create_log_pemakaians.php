<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogPemakaians extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_pemakaians', function (Blueprint $table) {
            $table->increments('idLogPemakaian');
            $table->string('namaAlatBahan');
            $table->string('namaStatusPenggunaan');
            $table->timestamp('tglTrx');
            $table->integer('jumlah');

            //foreign key
            $table->foreign('namaAlatBahan')->references('namaAlatBahan')->on('mst_alat_bahans')->onDelete('cascade');
            $table->foreign('namaStatusPenggunaan')->references('namaStatusPenggunaan')->on('mst_status_penggunaans')->onDelete('cascade');

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
        Schema::dropIfExists('log_pemakaians');
    }
}
