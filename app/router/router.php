<?php

function routes(): array
{
    return require 'web.php';
}

function ifTheUriMatchInArrayRoutes(string $uri, array $routes): array
{
    if (array_key_exists($uri, $routes)) {
        return [$uri => $routes[$uri]];
    }

    return [];
}

function ifRegularExpressionMatchArrayRoutes(string $uri, array $routes): array
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

function params($uri, $matchedUri)
{
    if (!empty($matchedUri)) {
        $matchedToGetParams = array_keys($matchedUri)[0];

        return array_diff(
            explode('/', ltrim($uri, '/')),
            explode('/', ltrim($matchedToGetParams, '/')),
        );
    }

    return [];
}

function formatParams($uri, $params)
{
    $uri = explode('/', ltrim($uri, '/'));

    $paramsData = [];
    foreach ($params as $index => $param) {
        $paramsData[$uri[$index - 1]] = $param;
    }

    return $paramsData;
}

function router()
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $routes = routes();

    $matchedUri = ifTheUriMatchInArrayRoutes($uri, $routes);
    if (empty($matchedUri)) {
        $matchedUri = ifRegularExpressionMatchArrayRoutes($uri, $routes);

        $params = params($uri, $matchedUri);
        $params = formatParams($uri, $params);

        var_dump($params);
        exit;
    }

    var_dump($matchedUri);
    exit;
}
