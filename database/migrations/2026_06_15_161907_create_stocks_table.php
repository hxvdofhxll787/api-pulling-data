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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->date('last_change_date');
            $table->string('supplier_article');
            $table->string('tech_size');
            $table->unsignedBigInteger('barcode');
            $table->unsignedInteger('quantity');
            $table->boolean('is_supply');
            $table->boolean('is_realization');
            $table->unsignedInteger('quantity_full');
            $table->string('warehouse_name');
            $table->unsignedInteger('in_way_to_client');
            $table->unsignedInteger('in_way_from_client');
            $table->unsignedBigInteger('nm_id');
            $table->string('subject');
            $table->string('category');
            $table->string('brand');
            $table->unsignedBigInteger('sc_code');
            $table->string('price');
            $table->string('discount');

            $table->index('nm_id');
            $table->index('barcode');
            $table->index('sc_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
