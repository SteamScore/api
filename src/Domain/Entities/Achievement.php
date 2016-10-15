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

namespace SteamScore\Api\Domain\Entities;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Achievement
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    /**
     * Gets the unique identifier.
     *
     * @return UuidInterface
     */
    public function getId() : UuidInterface
    {
        return $this->id;
    }
}
