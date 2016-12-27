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

namespace SteamScore\Api\Factory\Jobs;

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use SteamScore\Api\Domain\Jobs\FetchAllGamesJob;
use SteamScore\Api\Domain\Services\SteamSpyService;

final class FetchAllGamesJobFactory
{
    /**
     * Creates an instanced implementation of `SteamScore\Api\Domain\Jobs\FetchAllGamesJob`.
     *
     * @param ContainerInterface $container
     *
     * @return FetchAllGamesJob
     */
    public function __invoke(ContainerInterface $container): FetchAllGamesJob
    {
        return new FetchAllGamesJob(
            $container->get(EntityManagerInterface::class),
            $container->get(SteamSpyService::class)
        );
    }
}
