<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoPathToUploadsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uploads_photos', function (Blueprint $table) {
            $table->string('photo_path')->after('upload_user_id')->comment('画像パス');
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
            $table->dropColumn('photo_path');
        });
    }
}
