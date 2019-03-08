<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwKategorip extends Migration
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
DROP VIEW IF EXISTS `vw_kategorips`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_kategorips` AS
SELECT
    `k`.`namaKategori` AS `namaKategori`,
    COUNT(`mp`.`idKategori`) AS `banyakPenelitian`,
    (
        (
            COUNT(`mp`.`idKategori`) /(
            SELECT
                COUNT(
                    `sim-ukhp`.`mst_penelitians`.`idPenelitian`
                )
            FROM
                `sim-ukhp`.`mst_penelitians`
            WHERE
                (
                    `sim-ukhp`.`mst_penelitians`.`statusPenelitian` <> 4
                )
        )
        ) * 100
    ) AS `persenKategori`,
    MONTH(`mp`.`created_at`) AS `bulan`,
    YEAR(`mp`.`created_at`) AS `tahun`
FROM
    (
        `sim-ukhp`.`mst_penelitians` `mp`
    LEFT JOIN `sim-ukhp`.`kategoris` `k`
    ON
        ((`mp`.`idKategori` = `k`.`idKategori`))
    )
WHERE
    (`mp`.`statusPenelitian` <> 4)
GROUP BY
    MONTH(`mp`.`created_at`),
    YEAR(`mp`.`created_at`),
    `k`.`namaKategori`
SQL;
    }
}
