<?php

namespace Downloader\Formatters\UrlFormatter;

function formatUrl(string $url): string
{
    $urlComponents = parse_url($url);

    $filteredUrlComponents = array_filter(
        $urlComponents,
        fn($key) => $key !== "scheme",
        ARRAY_FILTER_USE_KEY
    );

    $name = array_reduce(
        $filteredUrlComponents,
        function ($acc, $item) {
            // $acc .= preg_replace('/[^0-9a-zA-Z]/', '-', $item);
            $acc .= preg_replace('/\W/', '-', $item);
            return $acc;
        },
        ""
    );

    return $name . ".html";
}
