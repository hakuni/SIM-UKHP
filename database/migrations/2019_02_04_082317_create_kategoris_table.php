<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->increments('idKategori');
            $table->string('namaKategori')->unique();
            
            $table->string('createdBy')->nullable();
            $table->string('updatedBy')->nullable();
            $table->timestamps();
        });
        DB::statement($this->insertKategori());
    }

    private function insertKategori() : string{
        return <<<SQL
INSERT INTO `kategoris` (`idKategori`, `namaKategori`, `createdBy`, `updatedBy`, `created_at`, `updated_at`) 
VALUES (NULL, 'Penyediaan Hewan Coba', 'kuni', NULL, NULL, NULL),
(NULL, 'Uji Antiinflamasi', 'kuni', NULL, NULL, NULL),
(NULL, 'Uji Toksisitas Akut (LD50)', 'kuni', NULL, NULL, NULL),
(NULL, 'Uji Toksisitas Subkronik', 'kuni', NULL, NULL, NULL),
(NULL, 'Uji Antidiabetes', 'kuni', NULL, NULL, NULL),
(NULL, 'Uji Antikolesterol', 'kuni', NULL, NULL, NULL),
(NULL, 'Uji Hepatoprotektor', 'kuni', NULL, NULL, NULL),
(NULL, 'Uji ASI Booster', 'kuni', NULL, NULL, NULL),
(NULL, 'Uji Aromaterapi', 'kuni', NULL, NULL, NULL),
(NULL, 'Uji Imunimodulator', 'kuni', NULL, NULL, NULL);
SQL;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategoris');
    }
}
