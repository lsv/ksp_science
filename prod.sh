#!/bin/bash

composer install
php app/console assets:install --env=prod
php app/console cache:clear --env=prod
chmod 777 -R app/cache app/logs