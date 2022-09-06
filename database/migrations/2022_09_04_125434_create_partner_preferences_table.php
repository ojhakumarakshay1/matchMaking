<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class CreatePartnerPreferencesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('partner_preferences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('prefered_annual_amount')->nullable();
            $table->string('prefered_occupation')->nullable();
            $table->string('prefered_family_type')->nullable();
            $table->enum('prefered_manglik', [PREFERED_MANGLIK_YES,PREFERED_MANGLIK_NO, PREFERED_MAGLINK_BOTH])->nullable();
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
        Schema::dropIfExists('partner_preferences');
        Schema::table('users', function($table)
        {
            $table->dropForeign('lists_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
