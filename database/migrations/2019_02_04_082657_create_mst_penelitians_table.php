<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstPenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_penelitians', function (Blueprint $table) {
            $table->increments('idPenelitian');
            $table->integer('idKategori')->unsigned();
            $table->integer('idDataClient')->unsigned();
            $table->integer('statusPenelitian')->unsigned();
            $table->integer('lastMilestoneID')->unsigned();
            
            //foreign key
            $table->foreign('idKategori')->references('idKategori')->on('kategoris')->onDelete('cascade');
            $table->foreign('idDataClient')->references('idDataClient')->on('mst_data_clients')->onDelete('cascade');
            $table->foreign('statusPenelitian')->references('idStatusPenelitian')->on('status_penelitians');
            $table->foreign('lastMilestoneID')->references('idMilestone')->on('mst_milestones');

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
        Schema::dropIfExists('mst_penelitians');
    }
}
