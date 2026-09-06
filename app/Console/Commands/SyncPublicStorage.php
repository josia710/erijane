<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * exFAT-safe replacement for `storage:link` (symlinks impossible on
 * exFAT, so public/storage is a physical mirror, not a link).
 * Copies new/changed files from storage/app/public → public/storage.
 */
class SyncPublicStorage extends Command
{
    protected $signature = 'storage:sync-public';

    protected $description = 'Mirror storage/app/public into public/storage (no-symlink volumes)';

    public function handle(): int
    {
        $source = storage_path('app/public');
        $target = public_path('storage');

        if (! is_dir($source)) {
            $this->error("Source missing: {$source}");

            return 1;
        }

        $copied = 0;
        foreach (File::allFiles($source) as $file) {
            $relative = $file->getRelativePathname();
            $dest = $target.DIRECTORY_SEPARATOR.$relative;
            if (! is_file($dest) || filemtime($dest) < $file->getMTime() || filesize($dest) !== $file->getSize()) {
                @mkdir(dirname($dest), 0755, true);
                copy($file->getPathname(), $dest);
                $copied++;
            }
        }

        $this->info("Synced {$copied} file(s) to public/storage.");

        return 0;
    }
}
