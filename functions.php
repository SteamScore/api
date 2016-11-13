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

/**
 * Gets the value of an environment variable. Supports boolean, empty and null.
 *
 * Based on `env()` by Taylor Otwell (https://laravel.com).
 *
 * @see https://github.com/laravel/framework for the canonical source repository
 *
 * @copyright Copyright (c) Taylor Otwell (https://laravel.com)
 * @license   https://github.com/laravel/framework/blob/master/LICENSE.md MIT License
 *
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 *
 * @param string $key
 * @param mixed  $default
 *
 * @return mixed
 */
function env($key, $default = null)
{
    $value = getenv($key);

    if ($value === false) {
        return $default;
    }

    switch (mb_strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'empty':
        case '(empty)':
            return '';
        case 'null':
        case '(null)':
            return;
    }

    if (mb_strlen($value) > 1 && mb_substr($value, 0, 1) === '"' && mb_substr($value, -1) === '"') {
        return mb_substr($value, 1, -1);
    }

    return $value;
}
