FROM hubdocker.libriciel.fr/php:8.3.6-fpm-alpine3.19 AS base

ENV XDEBUG_MODE='coverage'
ARG TIMEZONE=UTC
RUN ln -snf /usr/share/zoneinfo/$TIMEZONE /etc/localtime && echo $TIMEZONE > /etc/timezone


RUN <<EOF
    apk add bash
    apk add php83-intl php83-mbstring php83-pecl-pcov php83-xdebug
    cp /usr/lib/php83/modules/* /usr/local/lib/php/extensions/no-debug-non-zts-20230831/
    docker-php-ext-enable intl pcov
EOF

COPY --from=hubdocker.libriciel.fr/composer:2.7.4 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY --chown=www-data:www-data ./composer.* /app

RUN composer install

COPY --chown=www-data:www-data . /app