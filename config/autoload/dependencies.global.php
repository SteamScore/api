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

use Doctrine\ORM\EntityManagerInterface;
use Predis\Client;
use SteamScore\Api\Domain;
use SteamScore\Api\Factory;
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

return [
    'dependencies' => [
        'invokables' => [
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
        ],
        'factories' => [
            Application::class => ApplicationFactory::class,
            Client::class => Factory\PredisClientFactory::class,
            Domain\Interfaces\BucketManagerInterface::class => Factory\Managers\BucketManagerFactory::class,
            EntityManagerInterface::class => Factory\EntityManagerFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
        ],
    ],
];
