<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id')->autoIncrement();
            $table->string('name');
            $table->float('price');
            $table->string('discount')->nullable();
            $table->text('description')->nullable();
            $table->string('type');
            $table->string('external_code');
            $table->json('barcodes');
            $table->json('additional_features')->nullable();
            $table->timestamps();
        });

        Schema::create('product_characteristics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('product_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->string('photo_link')->nullable();
            $table->string('photo_path')->nullable();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE product_photos ADD photo LONGBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_characteristics');
        Schema::dropIfExists('product_photos');
        Schema::dropIfExists('products');
    }
};
