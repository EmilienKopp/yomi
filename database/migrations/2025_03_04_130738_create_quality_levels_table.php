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
        Schema::create('quality_levels', function (Blueprint $table) {
            $table->string('id')->nullable()->primary();
            $table->string('label')->nullable();
            $table->string('ai_model')->nullable();
            $table->decimal('multiplier', 8, 2)->nullable();
            $table->boolean('available_for_trial')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quality_levels');
    }
};
