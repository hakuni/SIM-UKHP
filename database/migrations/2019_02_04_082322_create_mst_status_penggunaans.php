<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstStatusPenggunaans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_status_penggunaans', function (Blueprint $table) {
            $table->increments('idStatusPenggunaan');
            $table->string('namaStatusPenggunaan')->unique();
        });
        DB::statement($this->insertStatus());
    }

    private function insertStatus() : string{
        return <<<SQL
INSERT INTO `mst_status_penggunaans` (`idStatusPenggunaan`, `namaStatusPenggunaan`) 
VALUES (NULL, 'Penelitian'), (NULL, 'Penjualan'), (NULL, 'Lain-lain');
SQL;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_status_penggunaans');
    }
}
