<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->string('roles')->default("user");
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('vaccinated')->default(0);
            $table->string("address")->nullable();
            $table->string("phone_number")->nullable();
            $table->date("date_of_birth")->nullable();
            $table->boolean('infected')->default(0);
            $table->string('certificate')->nullable();
            $table->boolean('suspended')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
