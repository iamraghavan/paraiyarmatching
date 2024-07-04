<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBirthPlaceAndBirthTimeToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('birth_place')->nullable(); // Adjust 'existing_column' to the column after which you want to add 'birth_place'
            $table->time('birth_time')->nullable()->after('birth_place');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('birth_place');
            $table->dropColumn('birth_time');
        });
    }
}