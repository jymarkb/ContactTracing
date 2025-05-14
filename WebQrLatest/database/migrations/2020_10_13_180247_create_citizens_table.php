<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('verifications', function (Blueprint $table) {
            $table->id('verifications_id');
            $table->string('verifications_name');
            
        });

        Schema::create('citizens', function (Blueprint $table) {
            $table->id('citizens_id');
            $table->string('citizens_fname',20);
            $table->string('citizens_mname',20);
            $table->string('citizens_lname',20);
            $table->string('citizens_suffix',5)->nullable();
            $table->date('citizens_bday');
            $table->string('citizens_gender',6);
            $table->string('citizens_profession',250);
            $table->string('citizens_mobile',11);
            $table->string('citizens_img_src');
            $table->string('citizens_qr_src')->nullable();

            $table->unsignedBigInteger('verifications_id');

            $table->string('citizen_add_address',100)->nullable();
            $table->string('citizen_add_address_current',100)->nullable();

            $table->unsignedBigInteger('zones_id')->nullable();
            $table->unsignedBigInteger('zones_id_current')->nullable();

            $table->unsignedBigInteger('barangays_id');
            $table->unsignedBigInteger('barangays_id_current');

            $table->unsignedBigInteger('municipalities_id');
            $table->unsignedBigInteger('municipalities_id_current');

            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('province_id_current');


            $table->foreign('province_id')
                ->references('province_id')
                ->on('provinces')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->foreign('municipalities_id')
                ->references('municipalities_id')
                ->on('municipalities')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
            
            $table->foreign('province_id_current')
                ->references('province_id')
                ->on('provinces')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->foreign('municipalities_id_current')
                ->references('municipalities_id')
                ->on('municipalities')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('barangays_id_current')
                ->references('barangays_id')
                ->on('barangays')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('zones_id_current')
                ->references('zones_id')
                ->on('zones')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('verifications_id')
                ->references('verifications_id')
                ->on('verifications')
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
        Schema::dropIfExists('citizens');
    }
}
