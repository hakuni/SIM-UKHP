<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwPenggunaanp extends Migration
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
DROP VIEW IF EXISTS `vw_penggunaanps;`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_penggunaanps` AS
SELECT
    MONTH(`lb`.`tglPembayaran`) AS `bulan`,
    YEAR(`lb`.`tglPembayaran`) AS `tahun`,
    SUM(`lb`.`totalPembayaran`) AS `pemasukan`
FROM
    `log_pembayarans` `lb`
GROUP BY
    MONTH(`lb`.`tglPembayaran`),
    YEAR(`lb`.`tglPembayaran`)
SQL;
    }
}
