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
            $table->increments('id');
            $table->text('images');
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->text('content');
            $table->string('product_code')->nullable();
            $table->string('product_sku')->nullable();
            $table->integer('category_id');
            $table->integer('quantity');
            $table->string('colors')->nullable();
            $table->string('sizes')->nullable();
            $table->string('genders');
            $table->string('regular_price');
            $table->tinyInteger('sale')->nullable();
            $table->boolean('is_Price_includes_taxes')->default(false);
            $table->tinyInteger('sale')->nullable();
            $table->boolean('isPublish')->default(true);
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
