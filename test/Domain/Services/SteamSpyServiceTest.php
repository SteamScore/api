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

namespace SteamScore\Api\Tests\Domain\Entities;

use bandwidthThrottle\tokenBucket\TokenBucket;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use SteamScore\Api\Domain\Services\SteamSpyService;
use SteamScore\Api\Tests\AbstractTestCase;

/**
 * @covers SteamScore\Api\Domain\Services\SteamSpyService
 */
class SteamSpyServiceTest extends AbstractTestCase
{
    /**
     * @var TokenBucket
     */
    private $bucket;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->bucket = $this->prophet->prophesize(TokenBucket::class);
    }

    /**
     * Tests that `findAll()` returns an array of all games.
     */
    public function testFindAll()
    {
        $this->bucket->consume(1, null)->willReturn(true);

        $json = '{"570":{"appid":570,"name":"Dota 2","developer":"Valve","publisher":"Valve","score_rank":78,"owners":87389155,"owners_variance":208295,"players_forever":87389155,"players_forever_variance":208295,"players_2weeks":9653059,"players_2weeks_variance":78703,"average_forever":11992,"average_2weeks":1208,"median_forever":300,"median_2weeks":695,"ccu":838370,"price":"0"}}';
        $client = new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(200, [], $json),
            ])),
        ]);

        $service = new SteamSpyService($client, $this->bucket->reveal());

        $this->assertSame(json_decode($json, true), $service->findAll());
    }

    /**
     * Tests that `findByAppId()` returns a specific game.
     */
    public function testFindByAppId()
    {
        $this->bucket->consume(1, null)->willReturn(true);

        $json = '{"appid":730,"name":"Counter-Strike: Global Offensive","developer":"Valve","publisher":"Valve","score_rank":84,"owners":24966232,"owners_variance":123718,"players_forever":24314876,"players_forever_variance":122214,"players_2weeks":7999365,"players_2weeks_variance":71817,"average_forever":16778,"average_2weeks":851,"median_forever":5020,"median_2weeks":410,"ccu":539366,"price":"1499"}';
        $client = new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(200, [], $json),
            ])),
        ]);

        $service = new SteamSpyService($client, $this->bucket->reveal());

        $this->assertSame(json_decode($json, true), $service->findByAppId(730));
    }
}
