#!/usr/bin/env bash

php artisan queue:listen --queue=track-parser --tries=3
