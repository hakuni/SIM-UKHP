<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTrxPenelitians extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_trx_penelitians', function (Blueprint $table) {
            $table->increments('idTrxLog');
            $table->integer('idPenelitian')->unsigned();
            $table->string("namaMilestone");
            $table->string("PIC");
            $table->timestamp("createdDate");

            //foreign key
            $table->foreign('idPenelitian')->references('idPenelitian')->on('mst_penelitians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_trx_penelitians');
    }
}
