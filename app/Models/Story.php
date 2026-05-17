<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model {
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'cover_image', 'author', 'category_id',
        'age_group', 'reading_level', 'duration_minutes', 'is_published', 'audio_narration_url'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function pages() {
        return $this->hasMany(StoryPage::class);
    }

    public function quizzes() {
        return $this->hasMany(Quiz::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}