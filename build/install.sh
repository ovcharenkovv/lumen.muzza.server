#!/usr/bin/env bash

php artisan migrate:refresh
php artisan db:seed
composer dumpautoload
php artisan cache:clear
