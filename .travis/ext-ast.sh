#!/usr/bin/env bash
set -x

mkdir build

git clone --depth 1 https://github.com/nikic/php-ast.git build/ast

cd ./build/ast

phpize
./configure
make
make install

echo "extension=ast.so" >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini
