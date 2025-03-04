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
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            
            $table->string('word')->nullable();
            $table->integer('score')->nullable();
            $table->text('comment')->nullable();

            $table->foreignId('challenger_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('challengee_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('winner_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('passage_id')->nullable()->references('id')->on('passages')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};
