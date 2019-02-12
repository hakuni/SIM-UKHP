<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogPemakaians extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_pemakaians', function (Blueprint $table) {
            $table->increments('idLogPemakaian');
            $table->integer('idAlatBahan');
            $table->timestamp('tglTrx');
            $table->integer('jumlah');

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
        Schema::dropIfExists('log_pemakaians');
    }
}
