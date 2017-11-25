#!/usr/bin/env bash
set -e

# Install all required dependencies
cd /var/www/html \
    && composer install --no-dev --no-interaction --no-scripts --no-autoloader \
    && composer dump-autoload --optimize

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

exec "$@"

