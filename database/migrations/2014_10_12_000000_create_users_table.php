<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamp('dob')->nullable();
            $table->boolean('is_active')->default(0);
            $table->enum('gender', [GENDER_TYPE_MALE,GENDER_TYPE_FEMALE])->nullable();
            $table->decimal('annual_income')->nullable();
            $table->enum('occupation', [OCCUPATION_TYPE_PRIVATE_JOB,OCCUPATION_TYPE_GOVERNMENT_JOB,OCCUPATION_TYPE_BUSINESS])->nullable();
            $table->enum('family_type', [FAMILY_TYPE_JOINT,FAMILY_TYPE_NUCLEAR])->nullable();
            $table->boolean('is_manglik')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
