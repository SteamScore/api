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

namespace SteamScore\Api\Tests\Http\Actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SteamScore\Api\Http\Actions\VersionAction;
use SteamScore\Api\Tests\AbstractTestCase;

/**
 * @covers \SteamScore\Api\Http\Actions\VersionAction
 */
class VersionActionTest extends AbstractTestCase
{
    /**
     * Tests that the action is invokable.
     */
    public function testIfInvokable()
    {
        $request = $this->prophesize(ServerRequestInterface::class)->reveal();
        $inResponse = $this->prophesize(ResponseInterface::class)->reveal();
        $action = new VersionAction('1.0.0');
        $outResponse = $action($request, $inResponse);

        $this->assertInstanceOf(ResponseInterface::class, $outResponse);
        $this->assertNotSame($inResponse, $outResponse);
    }
}
