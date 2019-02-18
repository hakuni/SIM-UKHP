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
    `k`.`idKategori`,
    `k`.`namaKategori`,
    `p`.`idPenelitian`,
    `p`.`namaPeneliti`,
    `p`.`instansiPeneliti`,
    `p`.`telpPeneliti`,
    `p`.`emailPeneliti`,
    `p`.`alamatPeneliti`,
    `sp`.`idStatusPenelitian`,
    `sp`.`namaStatus`,
    CASE WHEN `mp`.`idProsedur` IS NULL THEN 0 ELSE `mp`.`idProsedur` END AS `idProsedur`
FROM
    `mst_penelitians` `p` LEFT JOIN `kategoris` `k` ON `p`.`idKategori` = `k`.`idKategori`
    LEFT JOIN `mst_prosedurs` `mp` ON `p`.`idPenelitian` = `mp`.`idPenelitian`
    LEFT JOIN `status_penelitians` `sp` ON `p`.`statusPenelitian` = `sp`.`idStatusPenelitian`
SQL;
    }
}