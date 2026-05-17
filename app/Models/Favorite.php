<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model {
    use HasFactory;

    protected $fillable = [
        'child_profile_id', 'story_id'
    ];

    public function childProfile() {
        return $this->belongsTo(ChildProfile::class);
    }

    public function story() {
        return $this->belongsTo(Story::class);
    }
}