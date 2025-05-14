<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('users_id');
            $table->string('users_fname',20);
            $table->string('users_mname',20);
            $table->string('users_lname',20);
            $table->string('users_suffix',3)->nullable();
            $table->string('users_gender',20);
            $table->date('users_bday');
            $table->string('users_mobile',11)->unique();
            $table->string('users_username',20)->unique()->nullable();
            $table->string('users_password',60)->nullable();
            $table->string('users_profile',255)->nullable();
            
            $table->unsignedBigInteger('types_id');
            $table->unsignedBigInteger('establishments_id')->nullable();

            $table->foreign('establishments_id')
                ->references('establishments_id')
                ->on('establishments')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('types_id')
                ->references('types_id')
                ->on('types')
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
        Schema::dropIfExists('users');
    }
}
