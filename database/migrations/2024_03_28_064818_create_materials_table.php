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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longText('spesification')->nullable();
            $table->integer('new_stock');
            $table->integer('limit_stock');
            $table->integer('used_stock');
            $table->foreignId('materials_type_id')->constrained('materials_type')->onDelete('cascade');
            $table->date('last_placement_date')->nullable();
            $table->string('purchase_link')->nullable();
            $table->json('selected_materials')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
