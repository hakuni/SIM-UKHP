<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstDataClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_data_clients', function (Blueprint $table) {
            $table->increments('idDataClient');
            $table->string('namaPeneliti');
            $table->string('instansiPeneliti')->nullable();
            $table->string('telpPeneliti');
            $table->string('emailPeneliti');
            $table->string('alamatPeneliti')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_data_clients');
    }
}
