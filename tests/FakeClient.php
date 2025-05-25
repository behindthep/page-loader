<?php

namespace Tests;

class FakeClient
{
    public function get($url): self
    {
        return $this;
    }

    public function getBody(): self
    {
        return $this;
    }

    public function getContents(): string
    {
        return '<html><body>Fake content</body></html>';
    }
}
