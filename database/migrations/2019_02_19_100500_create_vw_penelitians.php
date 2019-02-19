<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwPenelitians extends Migration
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
DROP VIEW IF EXISTS `vw_penelitians`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_penelitians` AS
SELECT
    `p`.`idPenelitian` AS `idPenelitian`,
    `k`.`idKategori` AS `idKategori`,
    `k`.`namaKategori` AS `namaKategori`,
    `mm`.`idMilestone` AS `idMilestone`,
    `mm`.`namaMilestone` AS `namaMilestone`,
    `mdc`.`namaPeneliti` AS `namaPeneliti`,
    `mdc`.`instansiPeneliti` AS `instansiPeneliti`,
    `mdc`.`telpPeneliti` AS `telpPeneliti`,
    `mdc`.`emailPeneliti` AS `emailPeneliti`,
    `mdc`.`alamatPeneliti` AS `alamatPeneliti`,
    `sp`.`idStatusPenelitian` AS `idStatusPenelitian`,
    `sp`.`namaStatus` AS `namaStatus`,
    CASE WHEN ISNULL(`mp`.`idProsedur`) THEN 0 ELSE `mp`.`idProsedur` END AS `idProsedur`
FROM
    `mst_penelitians` `p` LEFT JOIN `mst_data_clients` `mdc` ON `p`.`idDataClient` = `mdc`.`idDataClient`
    LEFT JOIN `kategoris` `k` ON `p`.`idKategori` = `k`.`idKategori`
    LEFT JOIN `status_penelitians` `sp` ON `p`.`statusPenelitian` = `sp`.`idStatusPenelitian`
    LEFT JOIN `mst_prosedurs` `mp` ON `p`.`idPenelitian` = `mp`.`idPenelitian`
    LEFT JOIN `mst_milestones` `mm` ON `p`.`lastMilestoneID` = `mm`.`idMilestone`
SQL;
    }
}