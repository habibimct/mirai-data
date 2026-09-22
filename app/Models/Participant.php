<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Participant extends Model
{
    protected $fillable = [
        'name',
        'age',
        'qualification',
        'photo',
        'place_of_birth',
        'date_of_birth',
        'address',
        'status',
        'japanese_skills',
        'materials',
        'motivation',
        'vision',
        'youtube_link',
        'welding_photos'
    ];

    protected $casts = [
        'welding_photos' => 'array',
    ];

    public function getAgeAttribute()
    {
        return $this->date_of_birth
            ? Carbon::parse($this->date_of_birth)->age
            : null;
    }

    use HasFactory;
}
