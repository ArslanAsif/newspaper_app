<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        //Add column 'name' to 'users' table
        Schema::table('users', function ($table) {
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Remove column 'name' from 'users' table
        Schema::table('users', function ($table) {
            $table->dropColumn('name');
        });
    }
}
