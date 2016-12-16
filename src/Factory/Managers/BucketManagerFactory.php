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

namespace SteamScore\Api\Factory\Managers;

use Interop\Container\ContainerInterface;
use Predis\Client;
use SteamScore\Api\Domain\Interfaces\BucketManagerInterface;
use SteamScore\Api\Domain\Managers\BucketManager;

final class BucketManagerFactory
{
    /**
     * Creates an instanced implementation of `SteamScore\Api\Domain\Interfaces\BucketManagerInterface`.
     *
     * @param ContainerInterface $container
     *
     * @return BucketManagerInterface
     */
    public function __invoke(ContainerInterface $container): BucketManagerInterface
    {
        return new BucketManager($container->get(Client::class), $container->get('config')['buckets']);
    }
}
