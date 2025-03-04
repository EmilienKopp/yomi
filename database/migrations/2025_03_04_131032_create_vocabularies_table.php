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
        Schema::create('vocabulary', function (Blueprint $table) {
            $table->id();
            $table->string('word')->nullable();

            $table->decimal('frequency', 10, 6)->nullable();
            $table->integer('frequency_rank')->nullable();
            $table->string('inflections')->nullable();
            $table->boolean('is_public')->nullable()->default(true);
            $table->jsonb('translations')->nullable();
            $table->jsonb('examples')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('POS_id')->references('id')->on('parts_of_speech')->onDelete('set null');
            $table->foreignId('language_id')->nullable()->constrained('languages')->nullOnDelete();
            $table->foreignId('inflection_of')->references('id')->on('vocabulary')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabulary');
    }
};
