<?php

use Spryker\Shared\Twig\TwigConstants;

$config[TwigConstants::ZED_TWIG_OPTIONS] = [
    'cache' => false,
    'debug' => true,
];
$config[TwigConstants::YVES_TWIG_OPTIONS] = [
    'cache' => false,
    'debug' => true,
];

$config[TwigConstants::YVES_PATH_CACHE_FILE] = sprintf(
    '%s/data/cache/Yves/twig/.pathCache',
    APPLICATION_ROOT_DIR
);

$config[TwigConstants::ZED_PATH_CACHE_FILE] = sprintf(
    '%s/data/cache/Zed/twig/.pathCache',
    APPLICATION_ROOT_DIR
);
