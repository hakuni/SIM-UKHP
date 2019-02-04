<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstKeuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_keuangans', function (Blueprint $table) {
            $table->increments('idKeuangan');
            $table->integer('idPenelitian');
            $table->timestamp('tglPembayaran');
            $table->integer('biaya');
            $table->boolean('statusPembayaran');
            
            $table->string('createdBy');
            $table->string('updatedBy')->nullable();
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
        Schema::dropIfExists('mst_keuangans');
    }
}
