<?php

namespace Downloader;

use GuzzleHttp\Client;

function downloadPage(string $url, string $outputPath, string $clientClass = Client::class): string
{
    if (!is_dir($outputPath)) {
        mkdir($outputPath, 0755, true);
    }

    $filename = getFileNameFromUrl($url);
    $filePath = rtrim($outputPath, '/') . '/' . $filename;

    $client = new $clientClass();
    $response = $client->get($url);
    $html = $response->getBody()->getContents();

    file_put_contents($filePath, $html);

    return $filePath;
}

function getFileNameFromUrl(string $url): string
{
    $parsedUrl = parse_url($url);

    $host = $parsedUrl['host'] ?? '';
    $path = $parsedUrl['path'] ?? '';

    return preg_replace('/\W/', '-', $host . $path) . '.html';
}
