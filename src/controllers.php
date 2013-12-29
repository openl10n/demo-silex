<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

$app->match('/', function() use ($app) {
    return new RedirectResponse('/en');
});

$app->match('/{locale}', function($locale) use ($app) {
    $app['locale'] = $locale;

    return $app['twig']->render('index.html.twig');
});

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }

    return new Response($message, $code);
});

return $app;
