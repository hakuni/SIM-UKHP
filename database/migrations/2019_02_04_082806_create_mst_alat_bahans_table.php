<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstAlatBahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_alat_bahans', function (Blueprint $table) {
            $table->increments('idAlatBahan');
            $table->string('namaAlatBahan');
            // $table->integer('tipeAlatBahan');
            $table->integer('stokAlatBahan');

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
        Schema::dropIfExists('mst_alat_bahans');
    }
}
