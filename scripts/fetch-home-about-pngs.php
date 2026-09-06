<?php

$root = dirname(__DIR__);
$destRoot = $root.'/public/images/chloe/cdn/home-about';
@mkdir($destRoot, 0777, true);

$pages = [
    'https://chloeting.com/',
    'https://chloeting.com/about',
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
    ]);
    $body = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($body !== false && $code < 400) ? $body : '';
}

$urls = [];
foreach ($pages as $page) {
    $html = httpGet($page, $headers);
    echo "page {$page} bytes=".strlen($html)."\n";
    if ($html === '') {
        continue;
    }
    preg_match_all('~(?:src|srcset|url\()\s*[=:]?\s*["\']?([^"\'\s\)]+)~i', $html, $m);
    foreach ($m[1] as $raw) {
        $raw = html_entity_decode(trim($raw), ENT_QUOTES | ENT_HTML5);
        if (str_starts_with($raw, '//')) {
            $raw = 'https:'.$raw;
        } elseif (str_starts_with($raw, '/')) {
            $raw = 'https://chloeting.com'.$raw;
        }
        if (str_contains($raw, '/_next/image?url=')) {
            parse_str(parse_url($raw, PHP_URL_QUERY) ?: '', $q);
            if (! empty($q['url'])) {
                $raw = urldecode($q['url']);
            }
        }
        if (! preg_match('~\.png(\?|$)~i', $raw)) {
            continue;
        }
        if (preg_match('~-100x100\.|/(350x445|324x324)/~', $raw)) {
            continue;
        }
        $urls[$raw] = true;
    }
}

$saved = 0;
foreach (array_keys($urls) as $url) {
    $name = basename(parse_url($url, PHP_URL_PATH) ?: 'asset.png');
    $name = preg_replace('~[^a-zA-Z0-9._-]+~', '-', $name) ?: 'asset.png';
    $dest = $destRoot.'/'.$name;
    if (is_file($dest) && filesize($dest) > 1000) {
        continue;
    }
    $bin = httpGet($url, $headers);
    if ($bin === '' || strlen($bin) < 100) {
        echo "MISS {$url}\n";

        continue;
    }
    file_put_contents($dest, $bin);
    $info = @getimagesizefromstring($bin);
    echo 'SAVE '.$name.' '.($info[0] ?? 0).'x'.($info[1] ?? 0).' '.strlen($bin)."\n";
    $saved++;
}

echo "png_urls=".count($urls)." saved={$saved}\n";

$wired = [
    'images/chloe/hero/chloeting-banner.e2207dc5.png',
    'images/chloe/hero/train.ff560bfb.png',
    'images/chloe/hero/connect.44ddc83d.png',
    'images/chloe/hero/monitor.d3c8005f.png',
    'images/chloe/hero/organize.039755f5.png',
    'images/chloe/hero/track-kcal-out.0355d0bf.png',
    'images/chloe/hero/track-kcal-in.7144c4b6.png',
    'images/chloe/hero/performance-audit.a8d696be.png',
    'images/chloe/ui/homepage-background-2025.png',
];
echo "--- wired ---\n";
foreach ($wired as $rel) {
    $p = $root.'/public/'.$rel;
    if (! is_file($p)) {
        echo "MISS {$rel}\n";

        continue;
    }
    $i = getimagesize($p);
    echo ($i[0] ?? 0).'x'.($i[1] ?? 0).' '.round(filesize($p) / 1024).'KB '.$rel."\n";
}
