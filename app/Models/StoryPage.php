<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryPage extends Model {
    use HasFactory;

    protected $fillable = [
        'story_id', 'page_number', 'image_url', 'content', 'audio_start_time', 'audio_end_time'
    ];

    public function story() {
        return $this->belongsTo(Story::class);
    }
}