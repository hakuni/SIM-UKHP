<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstProsedursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_prosedurs', function (Blueprint $table) {
            $table->increments('idProsedur');
            $table->integer('idPenelitian')->unsigned();
            $table->integer('idKategori')->unsigned();
            $table->integer('idAlatBahan')->unsigned();
            $table->string('judulPenelitian');
            $table->string('keteranganHewan');
            $table->text('perlakuan');
            $table->text('parameterUji');
            $table->text('desainPenelitian');
            $table->boolean('etikHewan');
            $table->boolean('laporan');
            $table->integer('tahap1');
            $table->integer('tahap2');
            $table->integer('tahap3');
            $table->integer('tahap4');

            //foreign key
            $table->foreign('idPenelitian')->references('idPenelitian')->on('mst_penelitians')->onDelete('cascade');
            $table->foreign('idKategori')->references('idKategori')->on('kategoris')->onDelete('cascade');
            $table->foreign('idAlatBahan')->references('idAlatBahan')->on('mst_alat_bahans')->onDelete('cascade');

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
        Schema::dropIfExists('mst_prosedurs');
    }
}
