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

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$header = <<<'EOF'
This file is part of SteamScore.

(c) SteamScore <code@steamscore.info>

This Source Code Form is subject to the terms of the Mozilla Public
License, v. 2.0. If a copy of the MPL was not distributed with this
file, You can obtain one at http://mozilla.org/MPL/2.0/.
EOF;

$config = Config::create();
$finder = Finder::create()->name('.php_cs')->ignoreDotFiles(false)->exclude([
    'build',
])->in(__DIR__);

$config->setFinder($finder);
$config->setIndent(str_repeat(' ', 4));
$config->setLineEnding("\n");
$config->setRiskyAllowed(true);
$config->setUsingCache(true);
$config->setRules([
    '@PHP56Migration' => true,
    '@PHP70Migration' => true,
    '@Symfony:risky' => true,
    'array_syntax' => [
        'syntax' => 'short',
    ],
    'combine_consecutive_unsets' => true,
    'declare_strict_types' => true,
    'dir_constant' => true,
    'ereg_to_preg' => true,
    'general_phpdoc_annotation_remove' => [],
    'header_comment' => [
        'header' => $header,
    ],
    'heredoc_to_nowdoc' => true,
    'linebreak_after_opening_tag' => true,
    'mb_str_functions' => true,
    'modernize_types_casting' => true,
    'no_multiline_whitespace_before_semicolons' => true,
    'no_php4_constructor' => true,
    'no_short_echo_tag' => true,
    'no_unreachable_default_argument_value' => true,
    'no_useless_else' => true,
    'no_useless_return' => true,
    'ordered_class_elements' => true,
    'ordered_imports' => true,
    'php_unit_strict' => true,
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_order' => true,
    'protected_to_private' => true,
    'psr4' => true,
    'semicolon_after_instruction' => true,
    'strict_comparison' => true,
    'strict_param' => true,
    'ternary_to_null_coalescing' => true,
]);

return $config;
