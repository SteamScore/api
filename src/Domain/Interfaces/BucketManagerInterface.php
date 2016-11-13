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

namespace SteamScore\Api\Domain\Interfaces;

use bandwidthThrottle\tokenBucket\TokenBucket;
use SteamScore\Api\Domain\Exceptions\InvalidBucketException;

interface BucketManagerInterface
{
    /**
     * Gets all buckets.
     *
     * @return TokenBucket[]
     */
    public function getAll(): array;

    /**
     * Get bucket by name.
     *
     *
     * @param string $name
     *
     * @throws InvalidBucketException
     *
     * @return TokenBucket
     */
    public function getByName(string $name): TokenBucket;
}
