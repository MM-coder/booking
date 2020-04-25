<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConnectColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name_first', 191)->change();
            $table->string('name_last', 191)->change();
            $table->text('access_token')->after('remember_token')->nullable();
            $table->text('refresh_token')->after('access_token')->nullable();
            $table->unsignedBigInteger('token_expires')->after('refresh_token')->nullable();
            $table->dropColumn(['country', 'region', 'division']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['token_expires', 'refresh_token', 'access_token']);
            $table->string('name_first', 50)->change();
            $table->string('name_last', 50)->change();

            $table->string('country');
            $table->string('region');
            $table->string('division')->nullable();
        });
    }
}
