#!/usr/bin/env bash
set -x

function build {
    phpize
    ./configure
    make
}

function cleanBuild {
    make clean
    build
}

function install {
    make install
    echo "extension=ast.so" >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini
}

if [[ -d "build" ]] ; then
    mkdir build
fi

git clone --depth 1 https://github.com/nikic/php-ast.git build/ast

cd ./build/ast

phpize
./configure
make
make install

echo "extension=ast.so" >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini
