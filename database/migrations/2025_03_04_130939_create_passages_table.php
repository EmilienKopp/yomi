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
        Schema::create('passages', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('content')->nullable();
            $table->text('prompt')->nullable();
            $table->text('language')->nullable();
            $table->integer('word_count')->nullable();
            $table->text('topic_string')->nullable();
            $table->decimal('rating', 3, 1)->nullable();
            $table->integer('nb_ratings')->nullable()->default(0);
            $table->integer('generation_duration')->nullable();
            $table->integer('total_time')->nullable();
            $table->json('api_response')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('language_id')->nullable()->constrained('languages')->nullOnDelete();
            $table->foreignId('topic_id')->nullable()->constrained('topics')->nullOnDelete();
            $table->foreignId('type_id')->nullable()->constrained('passage_types')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passages');
    }
};
