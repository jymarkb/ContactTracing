<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traces', function (Blueprint $table) {
            $table->id('traces_id');
            $table->datetime('traces_date_time');

            $table->unsignedBigInteger('scans_id')->nullable();
            $table->unsignedBigInteger('tags_id');

            $table->foreign('scans_id')
                ->references('scans_id')
                ->on('scans')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('tags_id')
                ->references('tags_id')
                ->on('tags')
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
        Schema::dropIfExists('traces');
    }
}
