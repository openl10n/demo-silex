<?php

// Local
$app['locale'] = 'en';

// Cache
$app['cache.path'] = __DIR__.'/../cache';

// Twig cache
$app['twig.options.cache'] = $app['cache.path'].'/twig';
