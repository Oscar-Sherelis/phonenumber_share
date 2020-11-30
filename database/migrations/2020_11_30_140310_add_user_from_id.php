<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserFromId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phonenumber_shares', function (Blueprint $table) {
             $table->integer('user_from_id')->after('user_id');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phonenumber_shares', function (Blueprint $table) {
            $table->dropColumn('user_from_id');
            //
        });
    }
}