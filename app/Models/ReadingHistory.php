<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingHistory extends Model {
    use HasFactory;

    protected $fillable = [
        'child_profile_id', 'story_id', 'completed', 'progress_page', 'time_spent_seconds'
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function childProfile() {
        return $this->belongsTo(ChildProfile::class);
    }

    public function story() {
        return $this->belongsTo(Story::class);
    }
}