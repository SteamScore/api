set -x
if [ "$TRAVIS_PHP_VERSION" = '7.0' ] ; then
    node_modules/.bin/hercule docs/steamscore.v1.apib -o build/steamscore.v1.apib
    node_modules/.bin/aglio -i build/steamscore.v1.apib -o build/steamscore.v1.html --theme-full-width
fi
