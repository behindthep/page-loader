<?php

namespace Downloader\Downloader;

use function Downloader\Formatters\UrlFormatter\formatUrl;

function downloadPage(string $url, string $outputPath, string $clientClass = \GuzzleHttp\Client::class): string
{
    $dirPath = getDirPath($outputPath);

    if (!file_exists($dirPath)) {
        mkdir($dirPath, 0755, true);
    }

    $fileName = formatUrl($url);
    $filePath = "{$dirPath}/{$fileName}";

    $content = getContent($clientClass, $url);
    file_put_contents($filePath, $content);

    return "Page was successfully downloaded into {$filePath}\n";
}

function getDirPath(string $outputPath): string
{
    $outputPath = trim($outputPath, '/');
    return realpath(__DIR__ . '/../files/' . $outputPath);
}

function getContent(string $clientClass, string $url): string
{
    try {
        $client = new $clientClass();
        return $client->get($url)->getBody()->getContents();
    } catch (\Exception $e) {
        exit("Error: {$e->getMessage()}\n");
    }
}
