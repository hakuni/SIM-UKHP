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
            $table->integer('idKeuangan');
            $table->integer('idAlatBahan');
            $table->integer('jumlah');
            $table->integer('biaya');
            $table->integer('total');

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
