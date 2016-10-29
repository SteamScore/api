<?php

declare(strict_types=1);

/*
 * This file is part of SteamScore.
 *
 * (c) SteamScore <code@steamscore.info>
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

use SteamScore\Api\Version;
use function SteamScore\Api\env;

return [
    'debug' => false,
    'config_cache_enabled' => true,
    'dependencies' => [
        'factories' => [
            'Zend\Expressive\FinalHandler' => Zend\Expressive\Container\WhoopsErrorHandlerFactory::class,
        ],
        'invokables' => [
            'Zend\Expressive\Whoops' => Whoops\Run::class,
            'Zend\Expressive\WhoopsPageHandler' => Whoops\Handler\PrettyPageHandler::class,
        ],
    ],
    'orm' => [
        'connection' => [
            'charset' => 'utf8mb4',
            'collate' => 'utf8mb4_unicode_ci',
            'dbname' => env('DB_DBNAME', 'steamscore'),
            'driver' => 'mysqli',
            'host' => env('DB_HOST', 'localhost'),
            'password' => env('DB_PASSWORD', 'steamscore'),
            'port' => env('DB_PORT', 3306),
            'user' => env('DB_USER', 'steamscore'),
        ],
        'mapping' => [
            'data/orm' => 'SteamScore\Api\Domain\Entities',
        ],
        'proxies' => 'data/proxies',
    ],
    'version' => (new Version(getcwd()))->getVersion(),
    'whoops' => [
        'json_exceptions' => [
            'display' => true,
            'show_trace' => true,
            'ajax_only' => false,
        ],
    ],
];
