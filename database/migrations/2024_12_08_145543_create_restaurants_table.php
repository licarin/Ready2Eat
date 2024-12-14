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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('admin_id')->nullable(); // Menjadikan admin_id nullable
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location');
            $table->decimal('average_price', 8, 2);
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null'); // Aturan ketika admin dihapus\
            $table->string('photos') ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
