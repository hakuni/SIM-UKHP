<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRincianBiayasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rincian_biayas', function (Blueprint $table) {
            $table->increments('idRincianBiaya');
            $table->integer('idPenelitian')->unsigned();
            $table->integer('idAlatBahan')->unsigned();
            $table->integer('idMilestone')->unsigned();
            $table->integer('jumlah');
            $table->integer('harga');
            $table->string('keterangan')->nullable();

            //foreign key
            $table->foreign('idPenelitian')->references('idPenelitian')->on('mst_penelitians')->onDelete('cascade');
            $table->foreign('idAlatBahan')->references('idAlatBahan')->on('mst_alat_bahans')->onDelete('cascade');
            $table->foreign('idMilestone')->references('idMilestone')->on('mst_milestones')->onDelete('cascade');

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
        Schema::dropIfExists('rincian_biayas');
    }
}
