<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugPlanningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_planning', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('drug_shop_id');
            $table->foreignId('planning_id')->constrained();
            $table->foreign('drug_shop_id')->references('id')->on('drug_shop');
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
        Schema::dropIfExists('drug_planning');
    }
}
