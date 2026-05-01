<?php

$projectRoot = dirname(__DIR__);
$sourceRoot = 'C:/Users/hp/Downloads/hj';
$viewsRoot = $projectRoot . '/resources/views/pages';
$publicAssetsRoot = $projectRoot . '/public/assets';

$pageMap = [
    'index.html' => ['view' => 'home', 'route' => 'home', 'uri' => '/'],
    'about.html' => ['view' => 'about', 'route' => 'about', 'uri' => '/about'],
    'rooms.html' => ['view' => 'rooms', 'route' => 'rooms', 'uri' => '/rooms'],
    'eatdrink.html' => ['view' => 'eatdrink', 'route' => 'eatdrink', 'uri' => '/eat-drink'],
    'experiences.html' => ['view' => 'experiences', 'route' => 'experiences', 'uri' => '/experiences'],
    'gallery.html' => ['view' => 'gallery', 'route' => 'gallery', 'uri' => '/gallery'],
    'contact.html' => ['view' => 'contact', 'route' => 'contact', 'uri' => '/contact'],
    'menu.html' => ['view' => 'menu', 'route' => 'menu', 'uri' => '/menu'],
];

if (! is_dir($viewsRoot) && ! mkdir($viewsRoot, 0777, true) && ! is_dir($viewsRoot)) {
    throw new RuntimeException("Unable to create views directory: {$viewsRoot}");
}

copyDirectory($sourceRoot . '/assets', $publicAssetsRoot);

foreach ($pageMap as $sourceFile => $config) {
    $sourcePath = $sourceRoot . '/' . $sourceFile;
    $html = file_get_contents($sourcePath);

    if ($html === false) {
        throw new RuntimeException("Unable to read source file: {$sourcePath}");
    }

    $title = matchValue('/<title>(.*?)<\/title>/is', $html) ?: 'Hotel Jindal';
    $head = matchValue('/<head[^>]*>(.*?)<\/head>/is', $html) ?: '';
    $body = matchValue('/<body[^>]*class="([^"]*)"[^>]*>(.*?)<\/body>/is', $html, 2) ?: '';
    $bodyClass = matchValue('/<body[^>]*class="([^"]*)"[^>]*>/is', $html) ?: 'bg-[#111] font-body text-white antialiased';

    [$headContent, $scriptContent] = extractHeadAndScripts($head, $body);

    $headContent = replacePaths($headContent, $pageMap);
    $body = replacePaths($body, $pageMap);
    $scriptContent = replacePaths($scriptContent, $pageMap);

    $blade = buildBlade($title, $bodyClass, $headContent, $body, $scriptContent);

    file_put_contents("{$viewsRoot}/{$config['view']}.blade.php", $blade);
}

function extractHeadAndScripts(string $head, string &$body): array
{
    $cleanHead = preg_replace('/<meta[^>]+charset[^>]*>\s*/i', '', $head);
    $cleanHead = preg_replace('/<meta[^>]+name="viewport"[^>]*>\s*/i', '', $cleanHead);
    $cleanHead = preg_replace('/<title>.*?<\/title>\s*/is', '', $cleanHead);
    $cleanHead = trim($cleanHead);

    $scripts = [];
    if (preg_match_all('/<script\b[^>]*>.*?<\/script>/is', $body, $matches)) {
        $scripts = $matches[0];
        $body = preg_replace('/<script\b[^>]*>.*?<\/script>\s*/is', '', $body);
    }

    return [$cleanHead, trim(implode("\n\n", $scripts))];
}

function replacePaths(string $content, array $pageMap): string
{
    if ($content === '') {
        return $content;
    }

    $content = preg_replace_callback('/(["\'])assets\/([^"\']+)(["\'])/i', static function ($matches) {
        return $matches[1] . "{{ asset('assets/{$matches[2]}') }}" . $matches[3];
    }, $content);

    foreach ($pageMap as $file => $config) {
        $routeExpr = "{{ route('{$config['route']}') }}";
        $content = preg_replace_callback(
            '/href=(["\'])' . preg_quote($file, '/') . '\1/i',
            static fn ($matches) => 'href=' . $matches[1] . $routeExpr . $matches[1],
            $content
        );
        $content = preg_replace_callback(
            '/action=(["\'])' . preg_quote($file, '/') . '\1/i',
            static fn ($matches) => 'action=' . $matches[1] . $routeExpr . $matches[1],
            $content
        );
    }

    $content = str_replace('aria-current="page"', '', $content);

    return trim($content);
}

function buildBlade(string $title, string $bodyClass, string $headContent, string $body, string $scriptContent): string
{
    $blade = "@extends('layouts.app')\n\n";
    $blade .= "@section('title', " . var_export(html_entity_decode(trim($title), ENT_QUOTES), true) . ")\n";
    $blade .= "@section('body_class', " . var_export(trim($bodyClass), true) . ")\n\n";

    if ($headContent !== '') {
        $blade .= "@section('head')\n{$headContent}\n@endsection\n\n";
    }

    $blade .= "@section('content')\n{$body}\n@endsection\n\n";

    if ($scriptContent !== '') {
        $blade .= "@section('scripts')\n{$scriptContent}\n@endsection\n";
    }

    return $blade;
}

function copyDirectory(string $source, string $destination): void
{
    if (! is_dir($source)) {
        throw new RuntimeException("Source directory not found: {$source}");
    }

    if (! is_dir($destination) && ! mkdir($destination, 0777, true) && ! is_dir($destination)) {
        throw new RuntimeException("Unable to create destination directory: {$destination}");
    }

    $items = scandir($source);
    if ($items === false) {
        throw new RuntimeException("Unable to scan directory: {$source}");
    }

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $sourcePath = $source . '/' . $item;
        $destinationPath = $destination . '/' . $item;

        if (is_dir($sourcePath)) {
            copyDirectory($sourcePath, $destinationPath);
            continue;
        }

        if (! copy($sourcePath, $destinationPath)) {
            throw new RuntimeException("Unable to copy file: {$sourcePath}");
        }
    }
}

function matchValue(string $pattern, string $subject, int $group = 1): ?string
{
    if (! preg_match($pattern, $subject, $matches)) {
        return null;
    }

    return $matches[$group] ?? null;
}
