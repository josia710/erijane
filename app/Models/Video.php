<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'date_label',
        'duration',
        'category',
        'image',
        'external_url',
        'sort',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'sort' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Back-compat for Blade that still reads $video['date'].
     */
    public function getDateAttribute(): ?string
    {
        return $this->attributes['date_label'] ?? null;
    }

    /**
     * YouTube video ID parsed from external_url (youtu.be/<id> or
     * youtube.com/watch?v=<id>). Null when no YouTube URL is set.
     */
    public function getYoutubeIdAttribute(): ?string
    {
        $url = (string) ($this->attributes['external_url'] ?? '');
        if ($url === '') {
            return null;
        }
        if (preg_match('~youtu\.be/([A-Za-z0-9_-]{6,})~', $url, $m) === 1) {
            return $m[1];
        }
        if (preg_match('~[?&]v=([A-Za-z0-9_-]{6,})~', $url, $m) === 1) {
            return $m[1];
        }

        return null;
    }
}
