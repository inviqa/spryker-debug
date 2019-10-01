<?php

$stores = [];

$allStoresExceptGlobal = [
    'GB',
];

// note: *all* locales of *all* the shops should be added here
$allLocales = [
    'en-gb' => 'en_GB',
];

// note: *all* countries of *all* the shops should be added here
$allCountries = [
    'GB',
];

// note: *all* possible currencies should be added here
$allCurrencies = [
    'GBP',
];

$queuePools = [
    'synchronizationPool' => [
        'GB-connection',
    ],
];

$contexts = [
    // shared settings for all contexts
    '*' => [
        'timezone' => 'Europe/Berlin',
        'dateFormat' => [
            // short date (01.02.12)
            'short' => 'd/m/Y',
            // medium Date (01. Feb 2012)
            'medium' => 'd. M Y',
            // date formatted as described in RFC 2822
            'rfc' => 'r',
            'datetime' => 'Y-m-d H:i:s',
        ],
    ],
    // settings for contexts (overwrite shared)
    'yves' => [],
    'zed' => [
        'dateFormat' => [
            // short date (2012-12-28)
            'short' => 'Y-m-d',
        ],
    ],
];

$stores['GLOBAL'] = [
    // different contexts
    'contexts' => $contexts,
    'locales' => $allLocales,
    'countries' => $allCountries,
    // internal and shop
    'currencyIsoCode' => 'EUR',
    'currencyIsoCodes' => $allCurrencies,
    'queuePools' => $queuePools,
    'storesWithSharedPersistence' => [],
];

$stores['GB'] = [
    // different contexts
    'contexts' => $contexts,
    'locales' => [
        // first entry is default
        'en-gb' => 'en_GB',
    ],
    // first entry is default
    'countries' => ['GB'],
    // internal and shop
    'currencyIsoCode' => 'GBP',
    'currencyIsoCodes' => ['GBP'],
    'queuePools' => $queuePools,
    // the list of stores with which this store shares database, the value is store name.
    // note: *all* stores except current one should be added here
    'storesWithSharedPersistence' => array_diff($allStoresExceptGlobal, ['GB']),
];

return $stores;
