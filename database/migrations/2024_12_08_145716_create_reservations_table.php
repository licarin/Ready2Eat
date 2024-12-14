<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reservations', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('table_id');
        $table->uuid('restaurant_id');
        $table->uuid('customer_id');
        $table->foreign('customer_id')->references('id')->on('customers');
        $table->foreign('restaurant_id')->references('id')->on('restaurants');
        $table->foreign('table_id')->references('id')->on('tables');
        $table->dateTime('reservation_time');
        $table->integer('guest_count');
        $table->enum('status', ['pending', 'confirmed', 'rejected', 'cancelled'])->default('pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
