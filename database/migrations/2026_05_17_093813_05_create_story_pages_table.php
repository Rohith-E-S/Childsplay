<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('story_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained()->cascadeOnDelete();
            $table->integer('page_number');
            $table->string('image_url')->nullable();
            $table->text('content')->nullable();
            $table->integer('audio_start_time')->nullable();
            $table->integer('audio_end_time')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('story_pages');
    }
};