<?php

use Symfony\Component\HttpFoundation\Response;

$app->match('/', function() use ($app) {
    return $app['twig']->render('index.html.twig');
})->bind('homepage');

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
