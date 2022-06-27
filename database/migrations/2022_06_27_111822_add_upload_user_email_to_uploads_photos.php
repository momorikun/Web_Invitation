<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUploadUserEmailToUploadsPhotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uploads_photos', function (Blueprint $table) {
            $table->string('upload_user_email')->after('photo_path')->comment('投稿者メールアドレス');
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
            $table->dropColumn('upload_user_email');
        });
    }
}
