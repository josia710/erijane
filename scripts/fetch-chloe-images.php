<?php

/**
 * Download public Chloe Ting page images into public/images/chloe.
 * Study clone only — not affiliated with Chloe Ting.
 */

$root = dirname(__DIR__);
$destRoot = $root.'/public/images/chloe';

$pages = [
    'https://chloeting.com/',
    'https://chloeting.com/about',
    'https://chloeting.com/program',
    'https://chloeting.com/workout-video-library',
    'https://chloeting.com/recipes',
    'https://chloeting.com/community',
    'https://chloeting.com/login',
    'https://chloeting.com/signup',
];

$headers = [
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
    'Accept: text/html,application/xhtml+xml,image/avif,image/webp,*/*;q=0.8',
];

function httpGet(string $url, array $headers): string
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 45,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_SSL_VERIFYPEER => true,
    ]);
    $body = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err = curl_error($ch);
    curl_close($ch);
    if ($body === false || $code >= 400) {
        fwrite(STDERR, "GET fail {$code} {$url} {$err}\n");

        return '';
    }

    return $body;
}

function extractUrls(string $html, string $base): array
{
    $urls = [];
    $push = function (string $raw) use (&$urls, $base) {
        $raw = html_entity_decode(trim($raw), ENT_QUOTES | ENT_HTML5);
        if ($raw === '' || str_starts_with($raw, 'data:')) {
            return;
        }
        if (str_starts_with($raw, '//')) {
            $raw = 'https:'.$raw;
        } elseif (str_starts_with($raw, '/')) {
            $raw = 'https://chloeting.com'.$raw;
        } elseif (! preg_match('#^https?://#i', $raw)) {
            $raw = rtrim($base, '/').'/'.ltrim($raw, '/');
        }
        if (str_contains($raw, '/_next/image?url=')) {
            parse_str(parse_url($raw, PHP_URL_QUERY) ?: '', $q);
            if (! empty($q['url'])) {
                $raw = urldecode($q['url']);
            }
        }
        $path = parse_url($raw, PHP_URL_PATH) ?? '';
        $isAsset = (bool) preg_match('~\.(avif|jpe?g|png|webp|gif|svg)(\?|$)~i', $raw)
            || str_contains($raw, '/_next/static/media/')
            || str_contains($raw, 'static.chloeting.com')
            || str_contains($raw, 'static.private.chloeting.com');
        if (! $isAsset) {
            return;
        }
        if (preg_match('~-100x100\.|/(350x445|324x324|512x512|1024x576|16x9|4x3|1x1)/~', $path)
            || str_ends_with(strtolower($path), '.webp')) {
            return;
        }
        if (str_contains($path, '/recipes/') && preg_match('~-\d+\.(jpe?g|png)$~i', $path)
            && ! str_contains($path, 'cover') && ! str_contains($path, 'feature')) {
            return;
        }
        $urls[$raw] = true;
    };

    if (preg_match_all('/(?:src|data-src|poster)=["\']([^"\']+)["\']/i', $html, $m)) {
        foreach ($m[1] as $u) {
            $push($u);
        }
    }
    if (preg_match_all('/url\((["\']?)([^)\'"]+)\1\)/i', $html, $m)) {
        foreach ($m[2] as $u) {
            $push($u);
        }
    }
    if (preg_match_all('/(?:srcset|data-srcset)=["\']([^"\']+)["\']/i', $html, $m)) {
        foreach ($m[1] as $set) {
            foreach (preg_split('/\s*,\s*/', $set) as $part) {
                $u = trim(explode(' ', trim($part))[0]);
                $push($u);
            }
        }
    }
    if (preg_match_all('#https?://(?:static(?:\.private)?\.)?chloeting\.com[^"\'\s)]+#i', $html, $m)) {
        foreach ($m[0] as $u) {
            $push($u);
        }
    }
    if (preg_match_all('#/_next/image\?url=([^&"\']+)#i', $html, $m)) {
        foreach ($m[1] as $enc) {
            $push(urldecode($enc));
        }
    }

    return array_keys($urls);
}

function localPath(string $url, string $destRoot): string
{
    $parts = parse_url($url);
    $path = $parts['path'] ?? '/file';
    if (str_contains($path, '/_next/static/media/')) {
        $path = '/next/'.basename($path);
    } elseif (str_contains($path, '/_next/image')) {
        parse_str($parts['query'] ?? '', $q);
        $inner = urldecode($q['url'] ?? 'image.bin');
        $innerPath = parse_url($inner, PHP_URL_PATH) ?: '/image.bin';
        $path = '/next-image/'.ltrim($innerPath, '/');
    } elseif (($parts['host'] ?? '') === 'static.chloeting.com') {
        $path = '/cdn'.(str_starts_with($path, '/') ? $path : '/'.$path);
    } elseif (($parts['host'] ?? '') === 'static.private.chloeting.com') {
        $path = '/cdn-private'.(str_starts_with($path, '/') ? $path : '/'.$path);
    }
    $path = preg_replace('#[^a-zA-Z0-9._/-]#', '_', $path) ?: '/file.bin';
    $full = $destRoot.$path;
    if (! str_contains(basename($full), '.')) {
        $full .= '.bin';
    }

    return $full;
}

$seen = [];
$ok = 0;
$skip = 0;
$fail = 0;

foreach ($pages as $page) {
    echo "PAGE {$page}\n";
    $html = httpGet($page, $headers);
    if ($html === '') {
        continue;
    }
    foreach (extractUrls($html, $page) as $url) {
        if (isset($seen[$url])) {
            continue;
        }
        $seen[$url] = true;
        $dest = localPath($url, $destRoot);
        if (is_file($dest) && filesize($dest) > 32) {
            $skip++;

            continue;
        }
        $dir = dirname($dest);
        if (! is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
        $bin = httpGet($url, $headers);
        if ($bin === '' || strlen($bin) < 32) {
            $fail++;
            echo "  FAIL {$url}\n";

            continue;
        }
        file_put_contents($dest, $bin);
        $ok++;
        echo '  OK '.substr($dest, strlen($destRoot) + 1).' ('.strlen($bin).")\n";
        usleep(80_000);
    }
}

echo "done downloaded={$ok} skipped={$skip} failed={$fail} unique=".count($seen)."\n";
