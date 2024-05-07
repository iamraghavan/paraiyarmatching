<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageUrlsToPhotoGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photo_gallery', function (Blueprint $table) {
            $table->dropColumn('image_url');
            $table->string('image_url1')->nullable();
            $table->string('image_url2')->nullable();
            $table->string('image_url3')->nullable();
            $table->string('image_url4')->nullable();
            $table->string('image_url5')->nullable();
            $table->string('image_url6')->nullable();
            $table->string('image_url7')->nullable();
            $table->string('image_url8')->nullable();
            $table->string('image_url9')->nullable();
            $table->string('image_url10')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photo_gallery', function (Blueprint $table) {
            $table->string('image_url')->nullable();
            $table->dropColumn('image_url1');
            $table->dropColumn('image_url2');
            $table->dropColumn('image_url3');
            $table->dropColumn('image_url4');
            $table->dropColumn('image_url5');
            $table->dropColumn('image_url6');
            $table->dropColumn('image_url7');
            $table->dropColumn('image_url8');
            $table->dropColumn('image_url9');
            $table->dropColumn('image_url10');
        });
    }
}