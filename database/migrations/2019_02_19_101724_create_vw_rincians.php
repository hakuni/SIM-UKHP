<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwRincians extends Migration
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
DROP VIEW IF EXISTS `vw_rincians`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_rincians` AS
SELECT
    `r`.`idRincianBiaya`,
    `p`.`idPenelitian`,
    `b`.`namaAlatBahan`,
    `b`.`tipeAlatBahan`,
    `r`.`jumlah`,
    `r`.`harga`,
    (`r`.`jumlah` * `r`.`harga`) AS `total`
FROM
    `rincian_biayas` `r` LEFT JOIN `mst_penelitians` `p` 
    ON `r`.`idPenelitian` = `p`.`idPenelitian`
    LEFT JOIN `mst_alat_bahans` `b` ON `r`.`idAlatBahan` = `b`.`idAlatBahan`
SQL;
    }
}
