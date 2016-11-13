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

namespace SteamScore\Api\Factory\Actions;

use Interop\Container\ContainerInterface;
use SteamScore\Api\Http\Actions\VersionAction;

final class VersionActionFactory
{
    /**
     * Creates an instance of `SteamScore\Api\Http\Actions\VersionAction`.
     *
     * @param ContainerInterface $container
     *
     * @return VersionAction
     */
    public function __invoke(ContainerInterface $container): VersionAction
    {
        return new VersionAction($container->get('config')['version']);
    }
}
