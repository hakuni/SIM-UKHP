<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_roles', function (Blueprint $table) {
            $table->increments('idRole');
            $table->string('namaRole');
            $table->string('createdBy');
            $table->string('updatedBy')->nullable();
            $table->timestamps();
        });
        DB::statement($this->insertRole());
    }

    private function insertRole() : string{
        return <<<SQL
INSERT INTO `mst_roles` (`idRole`, `namaRole`, `createdBy`, `updatedBy`, `created_at`, `updated_at`) 
VALUES (NULL, 'Admin', 'kuni', NULL, NULL, NULL),
(NULL, 'Manajer Mutu', 'kuni', NULL, NULL, NULL),
(NULL, 'Manajer Teknis', 'kuni', NULL, NULL, NULL),
(NULL, 'Manajer Administrasi', 'kuni', NULL, NULL, NULL)
SQL;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_roles');
    }
}
