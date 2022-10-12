<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('name');
            $table->string('size');
            $table->string('extension');
            $table->string('type');
            $table->string('path');

            $table->unsignedBigInteger('album_id')->nullable();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
}
