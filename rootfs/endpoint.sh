sleep 20
php7.2 bin/console doctrine:migrations:migrate
service php7.2-fpm start
nginx -g 'daemon off;'