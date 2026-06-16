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
            $table->date('last_change_date')->nullable();
            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();
            $table->BigInteger('barcode');
            $table->unsignedInteger('quantity');
            $table->boolean('is_supply')->nullable();
            $table->boolean('is_realization')->nullable();
            $table->unsignedInteger('quantity_full')->nullable();
            $table->string('warehouse_name');
            $table->unsignedInteger('in_way_to_client')->nullable();
            $table->unsignedInteger('in_way_from_client')->nullable();
            $table->BigInteger('nm_id');
            $table->string('subject')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            $table->unsignedBigInteger('sc_code')->nullable();
            $table->string('price')->nullable();
            $table->string('discount')->nullable();

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
