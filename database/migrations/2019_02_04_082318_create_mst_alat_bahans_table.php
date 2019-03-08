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
            $table->string('namaAlatBahan')->unique();
            $table->integer('tipeAlatBahan');
            $table->integer('harga');
            $table->string('satuan');

            $table->string('createdBy');
            $table->string('updatedBy')->nullable();
            $table->timestamps();
        });
        DB::statement($this->insertAlatBahan());
    }

    private function insertAlatBahan() : string{
        return <<<SQL
INSERT INTO `mst_alat_bahans` (`idAlatBahan`, `namaAlatBahan`, `tipeAlatBahan`, `harga`, `satuan`, `createdBy`, `updatedBy`, `created_at`, `updated_at`) 
VALUES (NULL, 'Tikus (Sprague Dawley)', 1, 50000, 'ekor', 'kuni', NULL, '2019/01/01','2019/01/01'),
(NULL, 'Mencit (ddY)', 1, 25000, 'ekor', 'kuni', NULL, '2019/01/01','2019/01/01'),
(NULL, 'Pakan Tikus - Mencit', 2, 15000, 'kg', 'kuni', NULL, '2019/01/01','2019/01/01'),
(NULL, 'Pakan HFD', 2, 35000, 'kg', 'kuni', NULL, '2019/01/01','2019/01/01'),
(NULL, 'Sekam', 2, 7500, 'buah', 'kuni', NULL, '2019/01/01','2019/01/01'),
(NULL, 'Biaya sewa Boks Tikus - Mencit', 2, 20000, 'boks', 'kuni', NULL, '2019/01/01','2019/01/01'),
(NULL, 'Biaya sewa ruangan', 2, 400000, 'ruangan/bulan', 'kuni', NULL, '2019/01/01','2019/01/01');
SQL;
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
