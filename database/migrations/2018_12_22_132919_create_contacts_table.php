<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('addressEnglish');
            $table->longText('addressArabic');
            $table->string('email');
            $table->string('phone');
            $table->string('mobile');
            $table->string('from');
            $table->string('to');
            $table->string('holidaysEnglish');
            $table->string('holidaysArabic');
            $table->double('latitude');
            $table->double('langitude');
            

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
        Schema::dropIfExists('contacts');
    }
}
