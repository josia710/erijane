<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityFeature extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
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
}
