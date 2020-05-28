#!/usr/bin/env bash
set -e

php bin/console cache:clear
php bin/console doctrine:migrations:migrate -n
php -S 0.0.0.0:$APP_PORT -t public/
