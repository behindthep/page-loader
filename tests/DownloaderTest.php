<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function Downloader\downloadPage;

class DownloaderTest extends TestCase
{
    protected function setUp(): void
    {
        if (!file_exists('/tmp/example')) {
            mkdir('/tmp/example', 0777, true);
        }
    }

    public function testDownloadPage()
    {
        $url = 'http://example.com';
        $outputPath = '/tmp/example';
        $clientClass = 'Tests\FakeClient';

        $filePath = downloadPage($url, $outputPath, $clientClass);

        $this->assertFileExists($filePath);
        $this->assertStringContainsString('Fake content', file_get_contents($filePath));
    }
}
