<?php

use App\Enums\CEFR;
use App\Enums\IELTS;
use App\Enums\JLPT;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('difficulties', function (Blueprint $table) {
            $table->id();
            $table->text('code')->unique();
            $table->text('name');
            $table->integer('level')->default(0);
            $table->enum('cefr', CEFR::values())->nullable();
            $table->enum('ielts', IELTS::values())->nullable();
            $table->enum('jlpt', JLPT::values())->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('difficulties');
    }
};
