<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddAadhaarNumberToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'aadhaar_number')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('aadhaar_number')->after('phone')->nullable(false);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'aadhaar_number')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('aadhaar_number');
            });
        }
    }
}