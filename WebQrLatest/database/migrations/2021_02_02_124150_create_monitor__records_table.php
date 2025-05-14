<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitorRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitor_records', function (Blueprint $table) {
            $table->id('monitor_records_id');
            $table->datetime('monitor_records_created');
            $table->unsignedBigInteger('monitors_id');
            $table->unsignedBigInteger('symptoms_id');

            $table->foreign('monitors_id')
                ->references('monitors_id')
                ->on('monitors')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('symptoms_id')
                ->references('symptoms_id')
                ->on('symptoms')
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
        Schema::dropIfExists('monitor__records');
    }
}
