FROM ubuntu:18.04
RUN apt-get update && apt-get install -yq --no-install-recommends \
                           apt-utils \
                           curl \
                           ca-certificates \
                           openssl \
                           nginx\
                           # Install php 7.2
                           php7.2-cli \
                           php7.2-json \
                           php7.2-curl \
                           php7.2-fpm \
                           php7.2-gd \
                           php7.2-ldap \
                           php7.2-mbstring \
                           php7.2-mysql \
                           php7.2-soap \
                           php7.2-sqlite3 \
                           php7.2-xml \
                           php7.2-zip \
                           php7.2-intl

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

COPY . /app
COPY rootfs/services/nginx/nginx.conf /etc/nginx/sites-available/default.conf
COPY rootfs/services/php-fpm/www.conf /etc/php/7.2/fpm/pool.d/www.conf
RUN ln -s /etc/nginx/sites-available/default.conf /etc/nginx/sites-enabled/default.conf
RUN service nginx restart
RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

EXPOSE 8000
WORKDIR app
RUN composer install
RUN chmod +x rootfs/endpoint.sh

STOPSIGNAL SIGTERM

CMD rootfs/endpoint.sh