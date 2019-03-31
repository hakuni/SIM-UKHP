<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwAlatBahans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->dropView());
        DB::statement($this->createView());
    }
    
    private function dropView() : string{
        return <<<SQL
DROP VIEW IF EXISTS `vw_alatBahans`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_alatBahans` AS
SELECT DISTINCT
    `mb`.`namaAlatBahan` AS `namaAlatBahan`,
    (SELECT 
        CASE WHEN ISNULL(SUM(`lb`.`jumlah`)) THEN 0 ELSE SUM(`lb`.`jumlah`) END 
    FROM `log_pembelians` `lb`
    WHERE `lb`.`namaAlatBahan` = `mb`.`namaAlatBahan`) AS `jumlahBeli`,
    (SELECT
        CASE WHEN ISNULL(SUM(`lp`.`jumlah`)) THEN 0 ELSE SUM(`lp`.`jumlah`) END
    FROM `log_pemakaians` `lp`
    WHERE
    `lp`.`namaAlatBahan` = `mb`.`namaAlatBahan`) AS `jumlahPakai`,
    (SELECT 
        CASE WHEN ISNULL(SUM(`lb`.`jumlah`)) THEN 0 ELSE SUM(`lb`.`jumlah`) END 
    FROM `log_pembelians` `lb`
    WHERE `lb`.`namaAlatBahan` = `mb`.`namaAlatBahan`) -
    (SELECT
        CASE WHEN ISNULL(SUM(`lp`.`jumlah`)) THEN 0 ELSE SUM(`lp`.`jumlah`) END
    FROM `log_pemakaians` `lp`
    WHERE
    `lp`.`namaAlatBahan` = `mb`.`namaAlatBahan`) AS `stok`
FROM
    `mst_alat_bahans` `mb`
SQL;
    }
}
