FROM ubuntu:22.04

RUN apt update -yqq \
    && apt dist-upgrade -yqq \
    && apt install \
        wget \
        sudo \
        vim \
        curl \
        git \
        locales \
        -yqq

RUN apt install php-fpm php-intl php-mbstring php-xml php-zip php-curl -y

COPY --chown=www-data:www-data . /app

WORKDIR /app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENV XDEBUG_MODE='coverage'

RUN composer install


RUN apt -y install php-xdebug
