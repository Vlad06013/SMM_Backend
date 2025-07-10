#!/bin/bash


#rm -rf ./vendor
docker compose down
docker compose up -d --build

docker compose exec smm_duck_backend bash -c "cd /var/www && composer install --prefer-dist && php artisan migrate  &&  php artisan route:cache && php artisan key:generate && php artisan storage:link && php artisan config:cache"
docker compose exec smm_duck_backend bash -c "cd /var/www && php artisan migrate:fresh --database pgsql_test &&  php artisan config:clear"
