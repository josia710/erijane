<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class Media
{
    public static function url(?string $path): string
    {
        if (! is_string($path) || $path === '') {
            return self::placeholder();
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (is_file(public_path($path))) {
            return asset($path);
        }

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->url($path);
        }

        return self::placeholder();
    }

    public static function alt(?string $title, string $fallback = 'Erijane'): string
    {
        $title = trim((string) $title);

        return $title !== '' ? $title : $fallback;
    }

    public static function placeholder(): string
    {
        return asset(config('chloe.placeholder_image', 'images/erijane/icon-112.png'));
    }
}
