<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwHistory extends Migration
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
DROP VIEW IF EXISTS `vw_historys`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_historys` AS
SELECT
    `mp`.`idPenelitian` AS `idPenelitian`,
    `ltp`.`namaMilestone` AS `namaMilestone`,
    `mm`.`idMilestone` AS `idMilestone`,
    `tp`.`durasi` -(TO_DAYS(`tp`.`endDate`) - TO_DAYS(`tp`.`startDate`)) AS `durasi`,
    `u`.`email` AS `email`,
    `u`.`namaUser` AS `PIC`,
    CASE WHEN `mm`.`idMilestone` = 1 THEN "Prosedur Selesai" ELSE `tp`.`catatan` END AS `catatan`,
    `tp`.`filePath`
FROM
    `log_trx_penelitians` `ltp` LEFT JOIN `mst_penelitians` `mp` ON `ltp`.`idPenelitian` = `mp`.`idPenelitian`
    LEFT JOIN `mst_milestones` `mm` ON `ltp`.`namaMilestone` = `mm`.`namaMilestone`
    LEFT JOIN `users` `u` ON `u`.`email` = `ltp`.`PIC`
    LEFT JOIN `trx_penelitians` `tp` ON `tp`.`idPenelitian` = `mp`.`idPenelitian`
    AND `tp`.`idMilestone` = `mm`.`idMilestone`
ORDER BY
    `mp`.`idPenelitian`, `ltp`.`idTrxLog`
SQL;
    }
}
