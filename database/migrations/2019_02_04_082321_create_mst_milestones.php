<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstMilestones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_milestones', function (Blueprint $table) {
            $table->increments('idMilestone');
            $table->string('namaMilestone');
        });
        DB::statement($this->insertStatus());
    }

    private function insertStatus() : string{
        return <<<SQL
INSERT INTO `mst_milestones` (`idMilestone`, `namaMilestone`) 
VALUES (NULL, 'Pembuatan Prosedur'), (NULL, 'Pemeliharaan'), (NULL, 'Perlakuan'),
(NULL, 'Analisis'), (NULL, 'Pembuatan Laporan'), (NULL, 'Selesai');
SQL;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_milestones');
    }
}
