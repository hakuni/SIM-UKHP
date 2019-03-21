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
SELECT DISTINCT
    `p`.`idPenelitian` AS `idPenelitian`,
    `tp`.`idTrxPenelitian` AS `idTrxPenelitian`,
    `mp`.`idProsedur` AS `idProsedur`,
    `mp`.`judulPenelitian` AS `judulPenelitian`,
    `mdc`.`namaPeneliti` AS `namaPeneliti`,
    `mdc`.`instansiPeneliti` AS `instansiPeneliti`,
    `u`.`email` AS `email`,
    `u`.`namaUser` AS `namaUser`,
    `mm`.`idMilestone` AS `idMilestone`,
    `mm`.`namaMilestone` AS `namaMilestone`,
    (SELECT SUM(`lb`.`totalPembayaran`) FROM `log_pembayarans` `lb` WHERE `lb`.`idPenelitian` = `p`.`idPenelitian`) AS `totalBayar`,
    `vk`.`biaya` AS `biaya`,
    TO_DAYS(`tp`.`startDate`) + `tp`.`durasi` - TO_DAYS(NOW()) AS `sisaDurasi`,
    `tp`.`durasi` AS `durasi`,
    `mp`.`perlakuan` AS `perlakuan`,
    `p`.`updated_at` AS `updated_at`

    FROM
        `mst_penelitians` `p` LEFT JOIN `trx_penelitians` `tp` ON `p`.`idPenelitian` = `tp`.`idPenelitian`
         LEFT JOIN `mst_milestones` `mm` ON `p`.`lastMilestoneID` = `mm`.`idMilestone`
         LEFT JOIN `mst_prosedurs` `mp` ON `p`.`idPenelitian` = `mp`.`idPenelitian`
         LEFT JOIN `vw_keuangans` `vk` ON `vk`.`idPenelitian` = `p`.`idPenelitian`
         LEFT JOIN `mst_data_clients` `mdc` ON `p`.`idDataClient` = `mdc`.`idDataClient`
         LEFT JOIN `users` `u` ON `u`.`email` = `p`.`PIC`
SQL;
    }
}
