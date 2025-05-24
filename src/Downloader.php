<?php

namespace Downloader;

use GuzzleHttp\Client;

function downloadPage(string $url, string $outputPath, string $clientClass = Client::class): string
{
    $parsedUrl = parse_url($url);
    $host = $parsedUrl['host'] ?? '';
    $path = trim($parsedUrl['path'] ?? '', '/');
    $filename = preg_replace('/[^a-zA-Z0-9]+/', '-', $host . ($path ? '-' . $path : '')) . '.html';

    $filePath = rtrim($outputPath, '/') . '/' . $filename;

    if (!is_dir($outputPath)) {
        mkdir($outputPath, 0755, true);
    }

    $client = new $clientClass();
    $html = $client->get($url)->getBody()->getContents();

    file_put_contents($filePath, $html);

    return $filePath;
}
