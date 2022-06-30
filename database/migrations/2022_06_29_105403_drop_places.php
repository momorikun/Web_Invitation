<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPlaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('places');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('place_name')->comment('会場名');
            $table->decimal('latitude', 7, 4)->comment('緯度');
            $table->decimal('longitude', 7, 4)->comment('経度');
            $table->softDeletes();
            $table->timestamps();
        });
    }
}
