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
            $table->integer('idPenelitian');
            $table->integer('idKategori');
            $table->integer('idAlatBahan');
            $table->string('judulPenelitian');
            $table->integer('jumlahHewan');
            $table->string('perlakuan');
            $table->string('parameterUji');
            $table->string('desainPenelitian');

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
