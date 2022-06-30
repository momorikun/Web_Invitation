<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDateAndTimeInCeremonies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ceremonies', function (Blueprint $table) {
            $table->string('date_and_time')->comment('日時')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ceremonies', function (Blueprint $table) {
            $table->dateTime('date_and_time')->comment('開催日時');
        });
    }
}
