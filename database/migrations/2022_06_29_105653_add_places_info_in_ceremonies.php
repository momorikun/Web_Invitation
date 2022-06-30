<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlacesInfoInCeremonies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ceremonies', function (Blueprint $table) {
            $table->string('place_name')->after('ceremony_admin_id')->comment('会場名');
            $table->decimal('latitude', 7, 4)->after('place_name')->comment('緯度');
            $table->decimal('longitude', 7, 4)->after('latitude')->comment('経度');
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
            $table->dropColumn(['place_name', 'latitude', 'longitude']);
        });
    }
}
