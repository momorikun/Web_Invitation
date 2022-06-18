<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('place_name')->comment('会場名');
            // $table->string('state')->comment('県');
            // $table->string('city')->comment('市');
            // $table->string('address_line')->comment('町名以降');
            $table->decimal('latitude', 7, 4)->comment('緯度');
            $table->decimal('longitude', 7, 4)->comment('経度');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
