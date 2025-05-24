<?php

namespace Tests;

class FakeClient
{
    public function get($url)
    {
        return new class {
            public function getBody()
            {
                return new class {
                    public function getContents()
                    {
                        return '<html><body>Fake content</body></html>';
                    }
                };
            }
        };
    }
}
