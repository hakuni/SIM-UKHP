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
SELECT
    `mb`.`idAlatBahan`,
    `mb`.`namaAlatBahan`,
    CASE WHEN(`mb`.`stokAlatBahan` = 0) THEN 0 ELSE `mb`.`stokAlatBahan` END +
    CASE WHEN ISNULL(SUM(`lb`.`jumlah`)) THEN 0 ELSE SUM(`lb`.`jumlah`) END -
    CASE WHEN ISNULL(SUM(`lp`.`jumlah`)) THEN 0 ELSE SUM(`lp`.`jumlah`) END AS `stok`
FROM
    `mst_alat_bahans` `mb` LEFT JOIN `sim-ukhp`.`log_pembelians` `lb` ON `mb`.`idAlatBahan` = `lb`.`idAlatBahan`
    LEFT JOIN `sim-ukhp`.`log_pemakaians` `lp` ON `mb`.`idAlatBahan` = `lp`.`idAlatBahan`
GROUP BY `mb`.`idAlatBahan`, `mb`.`namaAlatBahan`, `mb`.`stokAlatBahan`
SQL;
    }
}
