<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->integer('id')->unique()->default(1);
            $table->longText('aboutUs');
            $table->longText('aboutUsArabic');
            $table->longText('vision');
            $table->longText('visionArabic');
            $table->integer('job');
            $table->integer('worker');
            $table->integer('client');
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
        Schema::dropIfExists('abouts');
    }
}
