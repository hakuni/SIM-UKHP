<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_pembayarans', function (Blueprint $table) {
            $table->increments('idLogPembayaran');
            $table->integer('idPenelitian')->unsigned();
            $table->timestamp('tglPembayaran');
            $table->integer('totalPembayaran');

            //foreign key
            $table->foreign('idPenelitian')->references('idPenelitian')->on('mst_penelitians')->onDelete('cascade');

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
        Schema::dropIfExists('log_pembayarans');
    }
}
