<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwKeuangans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->dropViewLog());
        DB::statement($this->createViewLog());
        DB::statement($this->dropView());
        DB::statement($this->createView());
    }
    
    private function dropViewLog() : string{
        return <<<SQL
DROP VIEW IF EXISTS `vw_logPembayaran`;
SQL;
    }

    private function dropView() : string{
        return <<<SQL
DROP VIEW IF EXISTS `vw_keuangans`;
SQL;
    }

    private function createViewLog() : string{
        return <<<SQL
CREATE VIEW `vw_logPembayaran` AS
SELECT
    `l`.`idPenelitian`,
    MAX(`l`.`tglPembayaran`) AS `tgl`,
    SUM(`l`.`totalPembayaran`) AS `bayar`
FROM `log_pembayarans` `l` 
GROUP BY `l`.`idPenelitian`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_keuangans` AS
SELECT DISTINCT
    `p`.`idPenelitian`,
    `p`.`namaPeneliti`,
    `k`.`idKategori`,
    `k`.`namaKategori`,
    `lp`.`tgl`,
    CASE WHEN `r`.`jumlah` IS NULL THEN 0 ELSE SUM(`r`.`jumlah` * `r`.`harga`) END AS `biaya`,
    CASE WHEN `lp`.`bayar` >= SUM(`r`.`jumlah` * `r`.`harga`) THEN "LUNAS" ELSE "BELUM LUNAS" END AS `statusPembayaran`
FROM
    `mst_penelitians` `p`  LEFT JOIN `kategoris` `k` ON `p`.`idKategori` = `k`.`idKategori`
     LEFT JOIN `rincian_biayas` `r` ON `p`.`idPenelitian` = `r`.`idPenelitian`
     LEFT JOIN `vw_logPembayaran` `lp` ON `p`.`idPenelitian` = `lp`.`idPenelitian`
GROUP BY `p`.`idPenelitian`, `p`.`namaPeneliti`, `k`.`idKategori`, `k`.`namaKategori`, `lp`.`tgl`,
 `lp`.`bayar`, `r`.`jumlah`
SQL;
    }
}
