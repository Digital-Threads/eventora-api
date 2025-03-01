FROM php:8.3-fpm

WORKDIR /var/www

ADD https://github.com/mlocati/docker-php-extension-installer/releases/download/1.5.52/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && install-php-extensions \
    zip \
    bcmath \
    pgsql \
    pdo_pgsql \
    redis \
    opcache \
    imagick \
    @composer

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    nginx \
    supervisor

COPY composer.* ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --apcu-autoloader \
    --ansi \
    --no-scripts

COPY .docker/php.ini /usr/local/etc/php/conf.d/php.ini
COPY .docker/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY .docker/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY .docker/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY .docker/nginx.conf /etc/nginx/http.d/default.conf
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY --chown=www-data:www-data . .

RUN chmod +x .docker/entrypoint.sh && chmod -R ug+w /var/www/storage

EXPOSE 80

ENTRYPOINT [".docker/entrypoint.sh"]