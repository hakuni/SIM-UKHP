<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusPenelitians extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_penelitians', function (Blueprint $table) {
            $table->increments('idStatusPenelitian');
            $table->string('namaStatus')->unique();
        });
        DB::statement($this->insertStatus());
    }

    private function insertStatus() : string{
        return <<<SQL
INSERT INTO `status_penelitians` (`idStatusPenelitian`, `namaStatus`) 
VALUES (NULL, 'Rencana'), (NULL, 'Sedang Berlangsung'),
(NULL, 'Selesai'), (NULL, 'Batal Penelitian');
SQL;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_penelitians');
    }
}
