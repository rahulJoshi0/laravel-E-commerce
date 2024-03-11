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
        Schema::create('quote_items', function (Blueprint $table) {
            $table->id();
            $table->Integer('quote_id');
            $table->Integer('product_id');
            $table->string('name');
            $table->string('sku');
            $table->decimal('price', 10, 2);
            $table->integer('qty');
            $table->decimal('row_total', 10, 2);
            $table->text('custom_option')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_items');
    }
};
