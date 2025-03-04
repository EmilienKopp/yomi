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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('native_language')->nullable();
            $table->integer('point_balance')->nullable()->default(0);
            $table->string('user_number')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('native_language')->references('lang_code')->on('languages')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
