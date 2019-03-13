<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwClientTrack extends Migration
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
DROP VIEW IF EXISTS `vw_client_tracks`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_client_tracks` AS
SELECT
    `mp`.`idPenelitian` AS `idPenelitian`,
    `mp`.`resi` AS `resi`,
    `mm`.`idMilestone` AS `idMilestone`,
    `pro`.`judulPenelitian` AS `judulPenelitian`,
    `k`.`namaKategori` AS `namaKategori`,
    `mdc`.`namaPeneliti` AS `namaPeneliti`,
    `mdc`.`instansiPeneliti` AS `instansiPeneliti`,
    (
        CASE WHEN(`tp`.`endDate` IS NOT NULL) THEN 1 ELSE 0
    END
) AS `status`
FROM
    (
        (
            (
                (
                    (
                        `sim-ukhp`.`mst_penelitians` `mp`
                    LEFT JOIN `sim-ukhp`.`trx_penelitians` `tp`
                    ON
                        (
                            (
                                `tp`.`idPenelitian` = `mp`.`idPenelitian`
                            )
                        )
                    )
                LEFT JOIN `sim-ukhp`.`mst_milestones` `mm`
                ON
                    (
                        (
                            `mm`.`idMilestone` = `tp`.`idMilestone`
                        )
                    )
                )
            LEFT JOIN `sim-ukhp`.`kategoris` `k`
            ON
                ((`mp`.`idKategori` = `k`.`idKategori`))
            )
        LEFT JOIN `sim-ukhp`.`mst_data_clients` `mdc`
        ON
            (
                (
                    `mp`.`idDataClient` = `mdc`.`idDataClient`
                )
            )
        )
    LEFT JOIN `sim-ukhp`.`mst_prosedurs` `pro`
    ON
        (
            (
                `mp`.`idPenelitian` = `pro`.`idPenelitian`
            )
        )
    )
SQL;
    }
}
