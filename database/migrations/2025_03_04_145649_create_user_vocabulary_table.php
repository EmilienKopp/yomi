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
        Schema::create('user_vocabulary', function (Blueprint $table) {
            $table->id();
  
            $table->string('custom_translation')->nullable();
            $table->decimal('ease_factor', 5, 2)->nullable();
            $table->integer('repetition_count')->nullable();
            $table->integer('review_interval')->nullable();
            $table->timestamp('last_review_date')->nullable();
            $table->jsonb('metadata')->nullable();
            $table->timestamps();


            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vocabulary_id')->references('id')->on('vocabulary')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_vocabulary');
    }
};
