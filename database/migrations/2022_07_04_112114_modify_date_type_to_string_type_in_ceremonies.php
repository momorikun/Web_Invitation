<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDateTypeToStringTypeInCeremonies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ceremonies', function (Blueprint $table) {
            $table->string('wedding_date')->nullable()->after('bride_name')->comment('日付')->change();
            $table->string('reception_time')->nullable()->after('bride_name')->comment('受付時間')->change();
            $table->string('start_ceremony_time')->nullable()->after('reception_time')->comment('挙式開始時間')->change();
            $table->string('start_wedding_reception_time')->nullable()->after('start_ceremony_time')->comment('披露宴開始時間')->change();
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
            $table->date('wedding_date')->nullable()->after('bride_name')->comment('日付');
            $table->date('reception_time')->nullable()->after('bride_name')->comment('受付時間');
            $table->date('start_ceremony_time')->nullable()->after('reception_time')->comment('挙式開始時間');
            $table->time('start_wedding_reception_time')->nullable()->after('start_ceremony_time')->comment('披露宴開始時間');
        });
    }
}
