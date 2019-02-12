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
            $table->integer('idPenelitian');
            $table->timestamp('tglPembayaran');
            $table->integer('totalPembayaran');

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
