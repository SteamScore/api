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

namespace SteamScore\Api\Domain\Repositories;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;
use SteamScore\Api\Domain\Entities\Game;

final class GameRepository extends EntityRepository
{
}

/*

if (isset($params['sort']) === true) {
    if (is_array($params['sort']) === true) {
        die('fuck');
    }

    $params['sort']
}
*/
