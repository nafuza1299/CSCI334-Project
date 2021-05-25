<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthOrgStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_org_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->unique();
            $table->bigInteger('infected')->default(0);
            $table->bigInteger('recovered')->default(0);
            $table->bigInteger('deaths')->default(0);   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_org_statistics');
    }
}
