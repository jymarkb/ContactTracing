<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scans', function (Blueprint $table) {
            $table->id('scans_id');
            $table->string('scans_temperature',4);
            $table->datetime('scans_timein');
            $table->datetime('scans_timeout');
            $table->string('scans_status');
            $table->datetime('scans_timeupdate');
            $table->unsignedBigInteger('citizens_id');
            $table->unsignedBigInteger('establishments_id');
           

            $table->foreign('establishments_id')
                ->references('establishments_id')
                ->on('establishments')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('citizens_id')
                ->references('citizens_id')
                ->on('citizens')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scans');
    }
}
