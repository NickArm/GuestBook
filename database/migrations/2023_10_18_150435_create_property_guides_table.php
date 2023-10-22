<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_guides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->text('content'); // Will use text editor in the future
            $table->string('video_url')->nullable(); // Optional if they want to add YouTube link
            $table->string('video_file')->nullable(); // Optional if they upload an mp4
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('guide_categories')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_guides');
    }
};
