<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCordinatesTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cordinates_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cordinate_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('cordinate_id')->references('id')->on('cordinates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cordinates_tags');
    }
}
