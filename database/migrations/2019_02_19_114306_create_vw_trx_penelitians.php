<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwTrxPenelitians extends Migration
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
DROP VIEW IF EXISTS `vw_trxPenelitians`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_trxPenelitians` AS
SELECT
    `p`.`idPenelitian` AS `idPenelitian`,
    `tp`.`idTrxPenelitian` AS `idTrxPenelitian`,
    `mp`.`idProsedur` AS `idProsedur`,
    `mp`.`judulPenelitian` AS `judulPenelitian`,
    `mdc`.`namaPeneliti` AS `namaPeneliti`,
    `mdc`.`instansiPeneliti` AS `instansiPeneliti`,
    `ltp`.`PIC` AS `PIC`,
    `mm`.`idMilestone` AS `idMilestone`,
    `mm`.`namaMilestone` AS `namaMilestone`,
    `vk`.`biaya` AS `biaya`,
    TO_DAYS(`tp`.`startDate`) - TO_DAYS(NOW()) AS `durasi`,
    `mp`.`perlakuan` AS `perlakuan`
    
    FROM
        `mst_penelitians` `p` LEFT JOIN `trx_penelitians` `tp` ON `p`.`idPenelitian` = `tp`.`idPenelitian`
         LEFT JOIN `mst_milestones` `mm` ON `p`.`lastMilestoneID` = `mm`.`idMilestone`
         LEFT JOIN `log_trx_penelitians` `ltp` ON `p`.`idPenelitian` = `ltp`.`idPenelitian` 
         LEFT JOIN `mst_prosedurs` `mp` ON `p`.`idPenelitian` = `mp`.`idPenelitian`
         LEFT JOIN `vw_keuangans` `vk` ON `vk`.`idPenelitian` = `p`.`idPenelitian`
         LEFT JOIN `mst_data_clients` `mdc` ON `p`.`idDataClient` = `mdc`.`idDataClient`
SQL;
    }
}
