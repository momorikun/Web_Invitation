<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('gender')->after('kana')->comment('性別')->nullable();
            $table->integer('is_bride_side')->after('gender')->comment('新婦関係者')->nullable();
            $table->string('relationship')->after('gender')->comment('間柄')->nullable();
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
            $table->dropColumn('gender');
            $table->dropColumn('is_bride_side');
            $table->dropColumn('relationship');
        });
    }
}
