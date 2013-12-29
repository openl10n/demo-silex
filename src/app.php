<?php

use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;
use Symfony\Component\Translation\Loader\YamlFileLoader;

$app->register(new UrlGeneratorServiceProvider());

$app->register(new TranslationServiceProvider());
$app['locale_fallbacks'] = ['fr', 'en'];
$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());

    $translator->addResource('yaml', __DIR__.'/../resources/locales/messages.en.yml', 'en');
    $translator->addResource('yaml', __DIR__.'/../resources/locales/messages.es.yml', 'es');
    $translator->addResource('yaml', __DIR__.'/../resources/locales/messages.fr.yml', 'fr');

    return $translator;
}));

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../resources/log/app.log',
    'monolog.name'    => 'app',
    'monolog.level'   => 300 // = Logger::WARNING
));

$app->register(new TwigServiceProvider(), array(
    'twig.path' => array(__DIR__ . '/../resources/views'),
    'twig.options' => array(
        'cache' => isset($app['twig.options.cache']) ? $app['twig.options.cache'] : false,
        'strict_variables' => true
    ),
));

if ($app['debug'] && isset($app['cache.path'])) {
    $app->register(new ServiceControllerServiceProvider());
    $app->register(new WebProfilerServiceProvider(), array(
        'profiler.cache_dir' => $app['cache.path'].'/profiler',
    ));
}

return $app;
