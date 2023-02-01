#!/bin/sh

php /var/www/artisan ci -p -q
chmod -R 777 /var/www/storage/api-docs/api-docs.json

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
