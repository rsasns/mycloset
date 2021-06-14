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
            $table->bigIncrements('id');
            $table->string('user_id',20)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('name',100)->default('NO NAME');
            $table->string('image')->nullable();
            $table->string('bio',200)->nullable();
            $table->unsignedinteger('height')->nullable();
            $table->boolean('height_hidden')->default(0)->comment('0:公開、1:非公開');
            $table->unsignedinteger('age')->nullable();
            $table->boolean('age_hidden')->default(0)->comment('0:公開、1:非公開');
            $table->boolean('sex')->nullable()->comment('0:男、1:女');
            $table->boolean('sex_hidden')->default(0)->comment('0:公開、1:非公開');
            $table->string('homepage')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
