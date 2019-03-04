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
        DB::statement($this->dropView());
        DB::statement($this->createView());
    }

    private function dropView() : string{
        return <<<SQL
DROP VIEW IF EXISTS `vw_keuangans`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_keuangans` AS
SELECT DISTINCT
    `p`.`idPenelitian` AS `idPenelitian`,
    `mdc`.`namaPeneliti` AS `namaPeneliti`,
    `k`.`idKategori` AS `idKategori`,
    `k`.`namaKategori` AS `namaKategori`,
    (SELECT MAX(`l`.`tglPembayaran`) FROM `log_pembayarans` `l` WHERE `l`.`idPenelitian` = `p`.`idPenelitian`) AS `tgl`,
    (SELECT 
        CASE WHEN ISNULL(SUM(`r1`.`jumlah` * `r1`.`harga`)) THEN 0 ELSE SUM(`r1`.`jumlah` * `r1`.`harga`) END 
    FROM `rincian_biayas` `r1`
    WHERE `r1`.`idPenelitian` = `p`.`idPenelitian`) AS `biaya`,
    CASE WHEN (SELECT SUM(`l`.`totalPembayaran`) AS `bayar` FROM `log_pembayarans` `l` WHERE `l`.`idPenelitian` = `p`.`idPenelitian`) 
    >= (SELECT SUM(`r`.`jumlah` * `r`.`harga`) AS `biaya` FROM `rincian_biayas` `r` WHERE `r`.`idPenelitian` = `p`.`idPenelitian`) 
    THEN 'LUNAS' ELSE 'BELUM LUNAS' END AS `statusPembayaran`
FROM
    `mst_penelitians` `p` LEFT JOIN `kategoris` `k` ON `p`.`idKategori` = `k`.`idKategori`
    LEFT JOIN `mst_data_clients` `mdc` ON `p`.`idDataClient` = `mdc`.`idDataClient`
WHERE `p`.`statusPenelitian` < 4
SQL;
    }
}
