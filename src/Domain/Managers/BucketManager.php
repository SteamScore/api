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

namespace SteamScore\Api\Domain\Managers;

use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\storage\PredisStorage;
use bandwidthThrottle\tokenBucket\TokenBucket;
use Predis\Client;
use SteamScore\Api\Domain\Exceptions\InvalidBucketException;
use SteamScore\Api\Domain\Interfaces\BucketManagerInterface;

final class BucketManager implements BucketManagerInterface
{
    /**
     * @var array
     */
    private $buckets = [];

    /**
     * Constructor.
     *
     * @param Client $client
     * @param array  $buckets
     */
    public function __construct(Client $client, array $buckets)
    {
        foreach ($buckets as $name => $bucket) {
            $storage = new PredisStorage(sprintf('bucket:%s', $name), $client);
            $rate = new Rate($bucket['tokens'], $bucket['unit']);
            $this->buckets[$name] = new TokenBucket($bucket['capacity'], $rate, $storage);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(): array
    {
        return $this->buckets;
    }

    /**
     * {@inheritdoc}
     */
    public function getByName(string $name): TokenBucket
    {
        if (array_key_exists($name, $this->buckets) === false) {
            throw new InvalidBucketException(sprintf('Unknown bucket "%s"', $name));
        }

        return $this->buckets[$name];
    }
}
