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

namespace SteamScore\Api\Domain\Services;

use bandwidthThrottle\tokenBucket\TokenBucket;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use SteamScore\Api\Domain\Exceptions\RateLimitException;

final class SteamSpyService
{
    /**
     * @var string
     */
    const BASE_URI = 'https://steamspy.com/api.php';

    /**
     * @var string
     */
    const BUCKET = 'steamspy';

    /**
     * @var TokenBucket
     */
    private $bucket;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Constructor.
     *
     * @param ClientInterface $client
     * @param TokenBucket     $bucket
     */
    public function __construct(ClientInterface $client, TokenBucket $bucket)
    {
        $this->bucket = $bucket;
        $this->client = $client;
    }

    /**
     * Finds all games.
     *
     * @return array
     */
    public function findAll(): array
    {
        if ($this->bucket->consume(1, $seconds) === false) {
            throw new RateLimitException($seconds);
        }

        $response = $this->client->request('GET', self::BASE_URI, [
            'query' => [
                'request' => 'all',
            ],
        ]);

        return $this->parseResponse($response);
    }

    /**
     * Finds a game by its Steam AppId.
     *
     * @param int $appId
     *
     * @return array
     */
    public function findByAppId(int $appId): array
    {
        if ($this->bucket->consume(1, $seconds) === false) {
            throw new RateLimitException($seconds);
        }

        $response = $this->client->request('GET', self::BASE_URI, [
            'query' => [
                'appid' => $appId,
                'request' => 'appdetails',
            ],
        ]);

        return $this->parseResponse($response);
    }

    private function parseResponse(ResponseInterface $response): array
    {
        $body = (string) $response->getBody();

        // Clear json_last_error()
        json_encode(null);

        $json = json_decode($body, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            // @todo: Custom exception
            throw new \Exception(sprintf('Unable to decode data to JSON in %s: %s', __CLASS__, json_last_error_msg()));
        }

        return $json;
    }
}
