#!/bin/bash

composer install
php app/console cache:clear
chmod 777 -R app/cache app/logs