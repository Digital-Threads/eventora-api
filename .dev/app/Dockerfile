FROM php:8.1.14-fpm-alpine

ENV ENV="/root/.ashrc"

WORKDIR /var/www

ADD https://github.com/mlocati/docker-php-extension-installer/releases/download/1.5.52/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && install-php-extensions \
    zip-1.21.1 \
    bcmath-8.1.14 \
    pgsql-8.1.14 \
    pdo_pgsql-8.1.14 \
    redis-5.3.7 \
    opcache \
    @composer-2.5.1 \
    pcov-1.0.11 \
    xdebug-3.2.0

RUN apk update && apk add --no-cache \
    git \
    unzip \
    curl \
    nginx \
    supervisor \
    postgresql14-client

COPY ./nginx.conf /etc/nginx/http.d/default.conf
COPY ./php-fpm.conf /usr/local/etc/php-fpm.conf
COPY ./www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./entrypoint.sh /var/entrypoint.sh
COPY ./utilities.sh $ENV

RUN chmod +x /var/entrypoint.sh && chmod -R ug+w /var/www

EXPOSE 80

ENTRYPOINT ["/var/entrypoint.sh"]
