<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersTableColumnNullablefalseAddEmailVerifiedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::statement('UPDATE `users` SET `email` = "" WHERE `email` IS NULL');
            DB::statement('UPDATE `users` SET `password` = "" WHERE `password` IS NULL');

            $table->string('email')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
            $table->timestamp('email_verified_at')->nullable();
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
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();
            $table->dropColumn('email_verified_at');
        });
    }
}
