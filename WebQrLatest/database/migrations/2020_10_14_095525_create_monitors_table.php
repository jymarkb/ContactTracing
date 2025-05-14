<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitor_types', function (Blueprint $table) {
            $table->id('monitor_types_id');
            $table->string('monitor_types_name');
        });

        Schema::create('facilities', function (Blueprint $table) {
            $table->id('facilities_id');
            $table->string('facilities_desc');
        });

        Schema::create('monitors', function (Blueprint $table) {
            $table->id('monitors_id');
            $table->datetime('monitors_created');
            $table->datetime('monitors_updated')->nullable();
            $table->unsignedBigInteger('monitor_types_id');
            $table->unsignedBigInteger('tags_id');
            $table->unsignedBigInteger('facilities_id')->nullable();

            $table->foreign('monitor_types_id')
                ->references('monitor_types_id')
                ->on('monitor_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('tags_id')
                ->references('tags_id')
                ->on('tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('facilities_id')
                ->references('facilities_id')
                ->on('facilities')
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
        Schema::dropIfExists('monitors');
    }
}
