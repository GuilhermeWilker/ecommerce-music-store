<?php

function routes(): array
{
    return require 'web.php';
}

function ifTheUriMatchInArrayRoutes(string $uri, array $routes)
{
    if (array_key_exists($uri, $routes)) {
        return [$uri => $routes[$uri]];
    }

    return [];
}

function ifRegularExpressionMatchArrayRoutes($uri, $routes)
{
    return array_filter(
        $routes,
        function ($value) use ($uri) {
            $regex = str_replace('/', '\/', ltrim($value, '/'));

            return preg_match("/^$regex$/", ltrim($uri, '/'));
        },
        ARRAY_FILTER_USE_KEY
    );
}

function router()
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $routes = routes();

    $matchedUri = ifTheUriMatchInArrayRoutes($uri, $routes);
    if (empty($matchedUri)) {
        $matchedUri = ifRegularExpressionMatchArrayRoutes($uri, $routes);
    }

    var_dump($matchedUri);
    exit;
}
