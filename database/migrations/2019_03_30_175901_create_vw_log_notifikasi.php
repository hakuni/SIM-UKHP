<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwLogNotifikasi extends Migration
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
DROP VIEW IF EXISTS `vw_log_notifikasi`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_log_notifikasi` AS
SELECT
    `mp`.`idPenelitian` AS `idPenelitian`,
    `mp`.`PIC` AS `PIC`,
    `pro`.`judulPenelitian` AS `judulPenelitian`,
    `mm`.`idMilestone` AS `idMilestone`,
    `mm`.`namaMilestone` AS `namaMilestone`,
    case when `tp`.`durasi` is null then 0 else abs(`tp`.`durasi` - (date(NOW()) - date(`tp`.`startDate`))) end AS `durasi`,
    case when `tp`.`durasi` - (date(NOW()) - date(`tp`.`startDate`)) < 0 then 1 else 0 end as `statusTelat`
FROM
    `mst_penelitians` `mp`  LEFT JOIN `mst_prosedurs` `pro` ON `mp`.`idPenelitian` = `pro`.`idPenelitian`
    JOIN `mst_milestones` `mm` ON `mp`.`lastMilestoneID` = `mm`.`idMilestone`
    LEFT JOIN `trx_penelitian`s `tp` ON `mp`.`idPenelitian` = `tp`.`idPenelitian`
SQL;
    }
}
