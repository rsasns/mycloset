<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIndentityProvaidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('identity_providers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('identity_providers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
