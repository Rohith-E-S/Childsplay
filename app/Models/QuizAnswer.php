<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model {
    use HasFactory;

    protected $fillable = [
        'child_profile_id', 'quiz_id', 'is_correct'
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }

    public function childProfile() {
        return $this->belongsTo(ChildProfile::class);
    }
}