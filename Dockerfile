FROM php:8.2-cli as fpmidelibreapi

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    autoconf \
    build-essential \
    libzip-dev \
    && docker-php-ext-install zip

RUN pecl install xdebug-3.3.2 && docker-php-ext-enable xdebug

COPY --from=composer:2.7.2 /usr/bin/composer /usr/bin/composer

COPY . /app

RUN composer install
