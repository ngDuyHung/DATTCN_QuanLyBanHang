#!/bin/sh
set -e

echo "Starting php-fpm + nginx"
/usr/local/bin/docker-php-entrypoint php-fpm -D
exec nginx -g 'daemon off;'