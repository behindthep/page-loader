<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\FakeClient;

use function Downloader\downloadPage;

class DownloaderTest extends TestCase
{
    private string $outputPath = '/tmp/DownloaderTest';

    protected function setUp(): void
    {
        if (!file_exists($this->outputPath)) {
            mkdir($this->outputPath, 0777, true);
        }
    }

    public function testDownloadPage(): void
    {
        $url = 'http://example.com';
        $clientClass = FakeClient::class;

        $filePath = downloadPage($url, $this->outputPath, $clientClass);

        $this->assertFileExists($filePath);
        $this->assertStringContainsString('Fake content', file_get_contents($filePath));
    }
}
