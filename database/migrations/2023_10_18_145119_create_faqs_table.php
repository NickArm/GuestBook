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
    Schema::create('faqs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('property_id');
        $table->unsignedBigInteger('category_id');
        $table->text('question');
        $table->text('answer');
        $table->timestamps();

        // Foreign key constraints
        $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        $table->foreign('category_id')->references('id')->on('faq_categories')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }
};
