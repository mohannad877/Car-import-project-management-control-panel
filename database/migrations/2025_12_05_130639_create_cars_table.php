<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 80);
            $table->string('model', 120);
            $table->unsignedSmallInteger('year');
            $table->string('grade', 80)->nullable();
            $table->unsignedInteger('mileage')->nullable();
            $table->string('condition_status', 60)->nullable();
            $table->decimal('auction_price', 12, 2)->nullable();
            $table->decimal('estimated_cost', 12, 2)->nullable();
            $table->string('currency', 8)->default('USD');
            $table->string('location', 120)->nullable();
            $table->string('transmission', 40)->nullable();
            $table->string('engine', 60)->nullable();
            $table->string('fuel', 30)->nullable();
            $table->string('drive_type', 30)->nullable();
            $table->string('color', 40)->nullable();
            $table->string('vin', 32)->nullable();
            $table->string('lot_number', 32)->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();

            $table->index(['brand', 'model', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
