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

namespace SteamScore\Api;

use SebastianBergmann\Version as SebastianVersion;

final class Version extends SebastianVersion
{
    const VERSION = '1.0';

    /**
     * Constructor.
     */
    public function __construct()
    {
        // Let's use getcwd() since all entry points (hopefully) use
        // chdir() to change the working directory to our root path.
        return parent::__construct(self::VERSION, getcwd());
    }
}
