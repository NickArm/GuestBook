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
    Schema::create('properties', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('owner_id'); // Assuming you want to link the property to an owner.
        $table->string('title');
        $table->string('address');
        $table->string('country');
        $table->string('email');
        $table->string('phone');
        $table->time('check_in_time')->nullable();
        $table->time('check_out_time')->nullable();
        $table->string('pin')->nullable();
        $table->text('google_map_url')->nullable(); // This will store the Google Map URL
        $table->text('rules')->nullable(); // This will store the rules in text format
        $table->timestamps();

        // Foreign key constraint.
        $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
