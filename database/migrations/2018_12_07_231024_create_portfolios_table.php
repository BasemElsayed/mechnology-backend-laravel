<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maintenancePlace');
            $table->string('maintenanceScope');
            $table->string('maintenanceDuration');
            $table->string('maintenanceDescription');

            $table->string('maintenancePlaceArabic');
            $table->string('maintenanceScopeArabic');
            $table->string('maintenanceDurationArabic');
            $table->string('maintenanceDescriptionArabic');
            
            $table->string('imageURL');
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
        Schema::dropIfExists('portfolios');
    }
}
