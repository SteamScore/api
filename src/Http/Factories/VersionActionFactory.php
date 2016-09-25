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

namespace SteamScore\Api\Http\Factories;

use SteamScore\Api\Http\Actions\VersionAction;
use SteamScore\Api\Version;

final class VersionActionFactory
{
    /**
     * Creates an instance of `SteamScore\Api\Http\Actions\VersionAction`.
     *
     * @return VersionAction
     */
    public function __invoke()
    {
        return new VersionAction(new Version());
    }
}
