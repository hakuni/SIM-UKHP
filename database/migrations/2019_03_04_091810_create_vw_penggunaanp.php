<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwPenggunaanp extends Migration
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
DROP VIEW IF EXISTS `vw_penggunaanps`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_penggunaanps` AS
SELECT
    `mab`.`namaAlatBahan` AS `namaAlatBahan`,
    COUNT(`mp`.`idPenelitian`) AS `banyakPenelitian`,
    MONTH(`mp`.`created_at`) AS `bulan`,
    YEAR(`mp`.`created_at`) AS `tahun`
FROM
    (
        (
            `sim-ukhp`.`rincian_biayas` `rb`
        LEFT JOIN `sim-ukhp`.`mst_alat_bahans` `mab`
        ON
            (
                (
                    `rb`.`idAlatBahan` = `mab`.`idAlatBahan`
                )
            )
        )
    JOIN `sim-ukhp`.`mst_penelitians` `mp`
    ON
        (
            (
                `rb`.`idPenelitian` = `mp`.`idPenelitian`
            )
        )
    )
WHERE
    (
        (`mp`.`statusPenelitian` <> 4) AND(`mab`.`tipeAlatBahan` = 1)
    )
GROUP BY
    `mab`.`namaAlatBahan`,
    MONTH(`mp`.`created_at`),
    YEAR(`mp`.`created_at`)
SQL;
    }
}
