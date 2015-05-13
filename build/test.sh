#!/usr/bin/env bash

php artisan migrate:refresh
phpunit
phpmd ./app text codesize,unusedcode,naming

