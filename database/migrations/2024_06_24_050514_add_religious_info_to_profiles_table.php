<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReligiousInfoToProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {

            $table->string('star')->nullable();
            $table->string('raasi')->nullable();
            $table->string('dosham')->nullable();
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {

            $table->dropColumn('star');
            $table->dropColumn('raasi');
            $table->dropColumn('dosham');
        });
    }
}
