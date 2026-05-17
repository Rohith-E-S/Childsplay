<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('child_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('age');
            $table->string('reading_level')->nullable();
            $table->json('interests')->nullable();
            $table->string('avatar_url')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('child_profiles');
    }
};