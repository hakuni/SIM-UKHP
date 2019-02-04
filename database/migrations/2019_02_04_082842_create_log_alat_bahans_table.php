<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogAlatBahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_alat_bahans', function (Blueprint $table) {
            $table->increments('idLogAlatBahan');
            $table->integer('idAlatBahan');
            $table->integer('statusTrx');
            $table->timestamp('tglTrx');
            $table->integer('jumlah');
            $table->integer('harga');

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
        Schema::dropIfExists('log_alat_bahans');
    }
}
