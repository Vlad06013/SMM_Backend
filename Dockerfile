FROM grkunov/pre_build_php:jody

RUN groupmod -o -g 1000 www-data && \
    usermod -o -u 1000 -g www-data www-data

RUN apt-get update && \
    apt-get install -y cron supervisor

COPY docker/cron/crontab /etc/cron.d/laravel
RUN chmod 0644 /etc/cron.d/laravel && crontab /etc/cron.d/laravel

COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN touch /var/log/cron.log /var/log/php-fpm.log /var/log/php-fpm.err /var/log/cron.err

ENV HOME=/tmp
WORKDIR /var/www

COPY --chown=www-data:www-data . .

RUN chown -R www-data:www-data /var/www && chmod -R 775 /var/www

RUN git config --global --add safe.directory /var/www


RUN echo 'alias pa="php artisan"' >> ~/.bashrc
RUN echo 'alias pamodel="php artisan make:model"' >> ~/.bashrc
RUN echo 'alias fresh="php artisan migrate:fresh"' >> ~/.bashrc
RUN echo 'alias rc="php artisan route:cache"' >> ~/.bashrc
RUN echo 'alias cc="php artisan config:cache"' >> ~/.bashrc


EXPOSE 9000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
