<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_description', function (Blueprint $table) {
            $table->id('tag_desc_id');
            $table->string('tag_desc_name',50);
        });


        Schema::create('tags', function (Blueprint $table) {
            $table->id('tags_id');
            $table->datetime('tags_date_time');
            $table->unsignedBigInteger('tag_desc_id');
            $table->unsignedBigInteger('citizens_id');
            $table->unsignedBigInteger('users_id');

            $table->foreign('tag_desc_id')
                ->references('tag_desc_id')
                ->on('tag_description')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('citizens_id')
                ->references('citizens_id')
                ->on('citizens')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('users_id')
                ->references('users_id')
                ->on('users')
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
        Schema::dropIfExists('tags');
    }
}
