FROM hubdocker.libriciel.fr/php:8.3.6-fpm-alpine3.19 AS base

ARG TIMEZONE=UTC
RUN ln -snf /usr/share/zoneinfo/$TIMEZONE /etc/localtime && echo $TIMEZONE > /etc/timezone


RUN <<EOF
    apk update && apk upgrade
    apk add wget sudo vim curl git locales
    apk add php83-intl php83-mbstring php83-curl php83-sysvsem
    apk add font-terminus font-inconsolata font-dejavu font-noto font-noto-cjk font-awesome font-noto-extra
    cp /usr/lib/php83/modules/* /usr/local/lib/php/extensions/no-debug-non-zts-20230831/

    docker-php-ext-enable intl sysvsem
EOF

COPY --from=hubdocker.libriciel.fr/composer:2.7.4 /usr/bin/composer /usr/bin/composer

COPY --chown=www-data:www-data . /app

USER root

WORKDIR /app

ENV XDEBUG_MODE='coverage'

RUN composer install

RUN apk add php83-xdebug
