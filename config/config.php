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

use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Glob;

$cachedConfigFile = 'data/cache/app_config.php';
$config = [];

if (is_file($cachedConfigFile) === true) {
    return new ArrayObject(include $cachedConfigFile, ArrayObject::ARRAY_AS_PROPS);
}

foreach (Glob::glob('config/autoload/{{,*.}global,{,*.}local}.php', Glob::GLOB_BRACE) as $file) {
    $config = ArrayUtils::merge($config, include $file);
}

if (isset($config['config_cache_enabled']) === true && $config['config_cache_enabled'] === true) {
    file_put_contents($cachedConfigFile, '<?php return '.var_export($config, true).';');
}

return new ArrayObject($config, ArrayObject::ARRAY_AS_PROPS);
