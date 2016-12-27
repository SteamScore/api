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

namespace SteamScore\Api\Factory\Services;

use GuzzleHttp\Client;
use Interop\Container\ContainerInterface;
use SteamScore\Api\Domain\Interfaces\BucketManagerInterface;
use SteamScore\Api\Domain\Services\SteamSpyService;

final class SteamSpyServiceFactory
{
    /**
     * Creates an instanced implementation of `SteamScore\Api\Domain\Services\SteamSpyService`.
     *
     * @param ContainerInterface $container
     *
     * @return SteamSpyService
     */
    public function __invoke(ContainerInterface $container): SteamSpyService
    {
        $bucket = $container->get(BucketManagerInterface::class)->getByName(SteamSpyService::BUCKET);

        return new SteamSpyService(new Client(), $bucket);
    }
}
