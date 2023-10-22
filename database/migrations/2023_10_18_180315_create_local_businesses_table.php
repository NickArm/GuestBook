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
        Schema::create('local_businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('local_business_categories')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->text('image')->nullable(); // Will store image path.
            $table->text('google_map')->nullable();
            $table->text('directions_url')->nullable();
            $table->text('external_url')->nullable(); // For website or social media.
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
        Schema::dropIfExists('local_businesses');
    }
};
