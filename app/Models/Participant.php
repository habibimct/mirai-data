<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Participant extends Model
{
    protected $fillable = [
        'name',
        'qualification',
        'photo',
        'place_of_birth',
        'date_of_birth',
        'age',
        'address',
        'status',
        'japanese_skills',
        'materials',
        'motivation',
        'vision',
        'youtube_link',
        'skill_video_link',
        'welding_photos'
    ];

    protected $casts = [
        'welding_photos' => 'array',
    ];

    public function getAgeAttribute(): ?int
    {
        if (!$this->date_of_birth) {
            return null;
        }

        return Carbon::parse($this->date_of_birth)->age;
    }

    use HasFactory;
}
