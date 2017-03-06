<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_messages', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('image_path');
            $table->string('image_size');
            $table->string('image_name');
            $table->string('audio_path');
            $table->string('audio_size');
            $table->string('audio_name');
            $table->string('minister');
            $table->decimal('price');
            $table->string('category_name')->index();
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
        Schema::drop('audio_messages');
    }
}
