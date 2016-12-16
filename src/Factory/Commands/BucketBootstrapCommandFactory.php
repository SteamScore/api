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

namespace SteamScore\Api\Factory\Commands;

use Interop\Container\ContainerInterface;
use SteamScore\Api\Console\Commands\BucketBootstrapCommand;
use SteamScore\Api\Domain\Interfaces\BucketManagerInterface;

final class BucketBootstrapCommandFactory
{
    /**
     * Creates an instance of `SteamScore\Api\Console\Commands\BucketBootstrapCommand`.
     *
     * @param ContainerInterface $container
     *
     * @return BucketBootstrapCommand
     */
    public function __invoke(ContainerInterface $container): BucketBootstrapCommand
    {
        return new BucketBootstrapCommand($container->get(BucketManagerInterface::class));
    }
}
