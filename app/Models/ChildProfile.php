<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildProfile extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'age', 'reading_level', 'interests', 'avatar_url', 'reading_streak'
    ];

    protected $casts = [
        'interests' => 'array',
        'reading_streak' => 'integer',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function readingHistories() {
        return $this->hasMany(ReadingHistory::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function quizAnswers() {
        return $this->hasMany(QuizAnswer::class);
    }

    public function achievements() {
        return $this->belongsToMany(Achievement::class);
    }
}