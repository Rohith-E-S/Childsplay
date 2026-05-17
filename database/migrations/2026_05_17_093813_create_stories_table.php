<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('author')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('age_group')->nullable();
            $table->string('reading_level')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->boolean('is_published')->default(false);
            $table->string('audio_narration_url')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('stories');
    }
};