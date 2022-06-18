<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('kana')->after('name')->comment('フリガナ');
            $table->integer('user_categories_id')->after('password')->comment('role');
            $table->string('ceremonies_id', 50)->after('user_categories_id')->comment('挙式ID');
            $table->integer('is_attended')->after('ceremonies_id')->comment('出欠フラグ');
            $table->softDeletes()->comment('論理削除');
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
