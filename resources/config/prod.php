<?php

// Local
$app['locale'] = 'en';
//$app['translator.messages'] = array(
//    'en' => __DIR__.'/../resources/locales/messages.en.yml',
//);

// Cache
$app['cache.path'] = __DIR__.'/../cache';

// Twig cache
$app['twig.options.cache'] = $app['cache.path'].'/twig';
