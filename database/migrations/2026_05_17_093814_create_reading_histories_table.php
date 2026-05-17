<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('reading_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('story_id')->constrained()->cascadeOnDelete();
            $table->boolean('completed')->default(false);
            $table->integer('progress_page')->default(1);
            $table->integer('time_spent_seconds')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('reading_histories');
    }
};