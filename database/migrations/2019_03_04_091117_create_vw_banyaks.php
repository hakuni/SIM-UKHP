<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwbanyaks extends Migration
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
DROP VIEW IF EXISTS `vw_banyaks`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_banyaks` AS
SELECT
    `mab`.`idAlatBahan`
    `mab`.`namaAlatBahan` AS `namaAlatBahan`,
    SUM(`rb`.`jumlah`) AS `banyak`,
    MONTH(`rb`.`created_at`) AS `bulan`,
    YEAR(`rb`.`created_at`) AS `tahun`
FROM
    `rincian_biayas` `rb` JOIN `mst_alat_bahans` `mab` ON `mab`.`idAlatBahan` = `rb`.`idAlatBahan`
    JOIN `mst_penelitians` `mp` ON `mp`.`idPenelitian` = `rb`.`idPenelitian`
    WHERE `mp`.`statusPenelitian` <> 4 AND `mab`.`tipeAlatBahan` = 1
GROUP BY `mab`.`idAlatBahan`,`mab`.`namaAlatBahan`, MONTH(`rb`.`created_at`), YEAR(`rb`.`created_at`)
SQL;
    }
}
