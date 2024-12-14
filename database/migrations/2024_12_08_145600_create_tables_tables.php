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
    Schema::create('tables', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('restaurant_id');
        $table->foreign('restaurant_id')->references('id')->on('restaurants');
        $table->integer('number');
        $table->integer('seats');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
