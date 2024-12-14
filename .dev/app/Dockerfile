# Используем PHP 8.3 FPM на основе Alpine
FROM php:8.3-fpm-alpine

# Устанавливаем переменную окружения для удобного запуска скриптов
ENV ENV="/root/.ashrc"

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Добавляем инструмент для установки PHP-расширений
ADD https://github.com/mlocati/docker-php-extension-installer/releases/download/1.5.52/install-php-extensions /usr/local/bin/

# Делаем инструмент установки PHP-расширений исполняемым и устанавливаем расширения
RUN chmod +x /usr/local/bin/install-php-extensions && install-php-extensions \
    zip \
    bcmath \
    pgsql \
    pdo_pgsql \
    redis \
    opcache \
    @composer \
    pcov \
    xdebug

# Устанавливаем дополнительные пакеты, необходимые для Laravel и работы контейнера
RUN apk update && apk add --no-cache \
    git \
    unzip \
    curl \
    nginx \
    supervisor \
    postgresql15-client

# Копируем конфигурационные файлы в контейнер
COPY ./nginx.conf /etc/nginx/http.d/default.conf
COPY ./php-fpm.conf /usr/local/etc/php-fpm.conf
COPY ./www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./entrypoint.sh /var/entrypoint.sh
COPY ./utilities.sh $ENV

# Делаем скрипты исполняемыми и настраиваем права доступа
RUN chmod +x /var/entrypoint.sh && chmod -R ug+w /var/www

# Экспонируем порт 80 для Nginx
EXPOSE 80

# Устанавливаем скрипт начальной точки входа
ENTRYPOINT ["/var/entrypoint.sh"]
