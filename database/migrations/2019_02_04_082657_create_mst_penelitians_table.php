<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstPenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_penelitians', function (Blueprint $table) {
            $table->increments('idPenelitian');
            $table->integer('idKategori');
            $table->string('namaPeneliti');
            $table->string('instansiPeneliti');
            $table->string('telpPeneliti');
            $table->string('emailPeneliti');
            $table->string('alamatPeneliti');
            $table->integer('statusPenelitian');
            
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
        Schema::dropIfExists('mst_penelitians');
    }
}
