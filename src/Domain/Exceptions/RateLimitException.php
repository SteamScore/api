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

namespace SteamScore\Api\Domain\Exceptions;

use Exception;
use Throwable;

final class RateLimitException extends Exception
{
    /**
     * @var float
     */
    private $secondsToWait;

    /**
     * Constructor.
     *
     * @param float     $secondsToWait
     * @param string    $message
     * @param int       $code
     * @param Throwable $previous
     */
    public function __construct(float $secondsToWait, string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->secondsToWait = $secondsToWait;
    }

    /**
     * Gets seconds to wait.
     *
     * @return float
     */
    public function getSecondsToWait(): float
    {
        return $this->secondsToWait;
    }
}
