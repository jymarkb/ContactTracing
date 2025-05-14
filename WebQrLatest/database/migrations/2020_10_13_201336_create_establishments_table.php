<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->id('establishments_id');
            $table->string('establishments_name',50);
            $table->string('establishments_permit',50);
            $table->unsignedBigInteger('barangays_id');
            $table->unsignedBigInteger('zones_id');
            
            $table->string('establishments_add_address',50)->nullable();
            $table->string('establishments_pin',4)->nullable();

            $table->foreign('barangays_id')
                ->references('barangays_id')
                ->on('barangays')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('zones_id')
                ->references('zones_id')
                ->on('zones')
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
        Schema::dropIfExists('establishments');
    }
}
