<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model {
    use HasFactory;

    protected $fillable = [
        'story_id', 'question', 'options', 'correct_answer_index'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function story() {
        return $this->belongsTo(Story::class);
    }

    public function answers() {
        return $this->hasMany(QuizAnswer::class);
    }
}