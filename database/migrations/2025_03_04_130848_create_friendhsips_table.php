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
        Schema::create('friendships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('friend_id')
                ->references('id')
                ->on('users')
                ->constrained()
                ->cascadeOnDelete();
            $table->boolean('approved')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->integer('messages_exchanged')->nullable()->default(0);
            $table->integer('passages_exchanged')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friendships');
    }
};
