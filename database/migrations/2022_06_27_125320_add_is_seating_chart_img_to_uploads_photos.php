<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsSeatingChartImgToUploadsPhotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uploads_photos', function (Blueprint $table) {
            $table->integer('is_seating_chart')->after('upload_user_ceremony_id')->comment('座席表フラグ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uploads_photos', function (Blueprint $table) {
            $table->dropColumn('is_seating_chart');
        });
    }
}
