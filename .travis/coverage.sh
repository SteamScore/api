#!/usr/bin/env bash
if [ "$TRAVIS_PHP_VERSION" = '7.1' ] ; then
    wget https://scrutinizer-ci.com/ocular.phar
    phpdbg -qrr ./vendor/bin/phpunit || :
    php ocular.phar code-coverage:upload --format=php-clover ./build/logs/clover.xml
fi
