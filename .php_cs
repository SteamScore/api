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

use PhpCsFixer\Finder;
use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;

$finder = Finder::create()->exclude('build')->exclude('data')->in(__DIR__);
$header = <<<'EOF'
This file is part of SteamScore.

(c) Jonas Stendahl <jonas@stendahl.me>

This Source Code Form is subject to the terms of the Mozilla Public
License, v. 2.0. If a copy of the MPL was not distributed with this
file, You can obtain one at http://mozilla.org/MPL/2.0/.
EOF;

return PhpCsFixer\Config::create()->setRules([
    '@Symfony' => true,
    'combine_consecutive_unsets' => true,
    'dir_constant' => true,
    'ereg_to_preg' => true,
    'header_comment' => [
        'header' => $header
    ],
    'linebreak_after_opening_tag' => true,
    'modernize_types_casting' => true,
    'no_multiline_whitespace_before_semicolons' => true,
    'no_php4_constructor' => true,
    'no_short_echo_tag' => true,
    'no_useless_else' => true,
    'no_useless_return' => true,
    'not_operator_with_space' => true,
    'not_operator_with_successor_space' => true,
    'ordered_class_elements' => true,
    'ordered_imports' => true,
    'php_unit_construct' => true,
    'php_unit_dedicate_assert' => true,
    'php_unit_strict' => true,
    'phpdoc_order' => true,
    'random_api_migration' => true,
    'short_array_syntax' => true,
    'strict_comparison' => true,
    'strict_param' => true,

])->finder($finder);
