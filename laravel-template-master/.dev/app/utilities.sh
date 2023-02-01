alias comp="composer"
alias art="php /var/www/artisan"
alias supervisorctl="/usr/bin/supervisorctl -u root -p root -c /etc/supervisor/conf.d/supervisord.conf"
alias restart="supervisorctl restart fpm worker:* scheduler:*"
