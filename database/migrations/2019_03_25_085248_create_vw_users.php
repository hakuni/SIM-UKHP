<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwUsers extends Migration
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
DROP VIEW IF EXISTS `vw_users`;
SQL;
    }

    private function createView() : string{
        return <<<SQL
CREATE VIEW `vw_users` AS
SELECT
    `u`.`id`,
    `u`.`namaUser`,
    `u`.`email`,
    `mr`.`idRole`,
    `mr`.`namaRole`
FROM
    `users` `u` LEFT JOIN `mst_roles` `mr` ON `u`.`idRole` = `mr`.`idRole`
SQL;
    }
}
