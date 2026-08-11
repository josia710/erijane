<?php

namespace Tests\Unit;

use App\Support\Media;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaTest extends TestCase
{
    public function test_public_path_resolves_to_asset(): void
    {
        $url = Media::url('images/erijane/icon-112.png');

        $this->assertStringContainsString('images/erijane/icon-112.png', $url);
    }

    public function test_storage_public_path_resolves(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('products/demo.jpg', 'fake');

        $url = Media::url('products/demo.jpg');

        $this->assertStringContainsString('products/demo.jpg', $url);
    }

    public function test_missing_path_uses_placeholder(): void
    {
        $url = Media::url('missing/nope.jpg');

        $this->assertStringContainsString('erijane/icon-112.png', $url);
    }
}
