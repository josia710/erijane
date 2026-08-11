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
}
