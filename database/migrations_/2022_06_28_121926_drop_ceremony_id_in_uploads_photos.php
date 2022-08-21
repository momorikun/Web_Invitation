<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCeremonyIdInUploadsPhotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uploads_photos', function (Blueprint $table) {
            $table->dropColumn('ceremony_id');
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
            $table->string('upload_user_ceremony_id')->after('upload_user_email')->comment('挙式ID');
        });
    }
}
