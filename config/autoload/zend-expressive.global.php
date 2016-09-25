<?php

/*
 * This file is part of SteamScore.
 *
 * (c) Jonas Stendahl <jonas@stendahl.me>
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

return [
    'debug' => false,
    'config_cache_enabled' => false,
    'zend-expressive' => [
        'error_handler' => [
            'template_404' => 'error::404',
            'template_error' => 'error::error',
        ],
    ],
];
