<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrxPenelitians extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_penelitians', function (Blueprint $table) {
            $table->increments('idTrxPenelitian');
            $table->integer('idPenelitian')->unsigned();
            $table->integer("idMilestone")->unsigned();
            $table->string('PIC');
            $table->integer('durasi');
            $table->timestamp("startDate");
            $table->timestamp("endDate")->nullable();
            $table->string('filePath')->nullable();
            $table->string("catatan")->nullable();

            //foreign key
            $table->foreign('idPenelitian')->references('idPenelitian')->on('mst_penelitians')->onDelete('cascade');
            $table->foreign('idMilestone')->references('idMilestone')->on('mst_milestones')->onDelete('cascade');

            $table->string('createdBy');
            $table->string('updatedBy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_penelitians');
    }
}
