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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('lang_code')->unique();
            $table->string('name_en')->nullable();
            $table->string('name_native')->nullable();
            $table->boolean('enabled')->nullable()->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['lang_code']);
            $table->index(['name_en']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
