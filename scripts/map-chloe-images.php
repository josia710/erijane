<?php

$root = dirname(__DIR__);
$public = $root.'/public';
$chloe = $public.'/images/chloe';

$skipDir = '/(350x445|100x100|324x324|512x512|1024x576|16x9|4x3|1x1)(\/|$)/i';

$index = [];
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($chloe, FilesystemIterator::SKIP_DOTS));
foreach ($it as $file) {
    if (! $file->isFile()) {
        continue;
    }
    $path = str_replace('\\', '/', $file->getPathname());
    if (preg_match($skipDir, $path) || str_contains($path, '-100x100')) {
        continue;
    }
    $stem = strtolower(pathinfo($file->getFilename(), PATHINFO_FILENAME));
    $ext = strtolower($file->getExtension());
    $key = $stem.'.'.$ext;
    $size = $file->getSize();
    $isCdn = str_contains($path, '/cdn/');
    $cur = $index[$key] ?? null;
    $take = $cur === null
        || ($isCdn && ! $cur['cdn'])
        || ($isCdn === $cur['cdn'] && $size > $cur['size']);
    if ($take) {
        $index[$key] = ['path' => $file->getPathname(), 'size' => $size, 'cdn' => $isCdn];
    }
}

$need = [];
$cat = require $root.'/database/data/catalog.php';
foreach (['programs', 'videos', 'recipes', 'store'] as $g) {
    foreach ($cat[$g] as $row) {
        $need[$row['image']] = true;
    }
}
$site = require $root.'/database/data/site_defaults.php';
foreach ($site['assets'] as $p) {
    $need[$p] = true;
}

$copied = 0;
$missing = [];
foreach (array_keys($need) as $rel) {
    $dest = $public.'/'.$rel;
    $stem = strtolower(pathinfo($rel, PATHINFO_FILENAME));
    $ext = strtolower(pathinfo($rel, PATHINFO_EXTENSION));
    $hit = $index[$stem.'.'.$ext] ?? null;
    $src = $hit['path'] ?? null;
    $srcSize = $hit['size'] ?? 0;
    $destSize = is_file($dest) ? filesize($dest) : 0;

    if (! $src) {
        $missing[] = $rel;

        continue;
    }

    $realSrc = str_replace('\\', '/', $src);
    $realDest = str_replace('\\', '/', $dest);
    if ($realSrc === $realDest) {
        continue;
    }

    $destOk = $destSize > 32;
    if ($destOk && $ext === 'webp') {
        $destOk = str_starts_with((string) file_get_contents($dest, false, null, 0, 4), 'RIFF');
    }
    if ($destOk && in_array($ext, ['jpg', 'jpeg'], true)) {
        $destOk = bin2hex((string) file_get_contents($dest, false, null, 0, 2)) === 'ffd8';
    }

    if ($destOk && $destSize >= $srcSize) {
        continue;
    }

    $dir = dirname($dest);
    if (! is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    copy($src, $dest);
    $copied++;
    echo "copy {$rel} ({$srcSize} bytes)\n";
}

$aliases = [
    'images/chloe/recipes/best-vegan-matcha-latte-1676539049230-cover.webp' => 'strawberry-matcha-latte-1676441417799-cover',
    'images/chloe/recipes/berries-yogurt-parfait-1677185494994-cover.webp' => 'vegan-chocolate-yogurt-parfait-1676438419490-cover',
    'images/chloe/recipes/banana-oatmeal-pancakes-1673229768508-cover.webp' => 'high-protein-blueberry-pancakes-1675831886567-cover',
];
foreach ($aliases as $rel => $aliasStem) {
    $dest = $public.'/'.$rel;
    $hit = $index[$aliasStem.'.webp'] ?? $index[$aliasStem.'.jpeg'] ?? null;
    if (! $hit) {
        echo "ALIAS MISS {$rel}\n";

        continue;
    }
    $head = (string) file_get_contents($dest, false, null, 0, 4);
    if (is_file($dest) && str_starts_with($head, 'RIFF') && filesize($dest) >= $hit['size']) {
        continue;
    }
    copy($hit['path'], $dest);
    $copied++;
    echo "alias {$rel} <- {$aliasStem} ({$hit['size']} bytes)\n";
}

echo "copied={$copied} still_missing=".count($missing)."\n";
foreach ($missing as $m) {
    echo "MISS {$m}\n";
}
