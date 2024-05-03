<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('user_pmid')->unique();
            $table->integer('age')->nullable();
            $table->string('profile_image')->nullable();
            $table->date('dob')->nullable();
            $table->string('religion')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('height')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('disability')->nullable();
            $table->string('family_status')->nullable();
            $table->string('family_type')->nullable();
            $table->string('family_value')->nullable();
            $table->string('education')->nullable();
            $table->string('employed_in')->nullable();
            $table->string('occupation')->nullable();
            $table->string('annual_income')->nullable();
            $table->string('work_location')->nullable();
            $table->string('residing_state')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
