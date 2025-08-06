<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10);
            $table->string('image')->nullable();
            $table->string('url');
            $table->decimal('old_price', 10);
            $table->decimal('discount', 10);
            $table->enum('frequency', array_keys(Product::arrayFrequencies))->default(Product::FREQUENCY_DAILY);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_ended')->default(false);
            $table->timestamps();

            $table->foreignUuid('user_id')->index();
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
