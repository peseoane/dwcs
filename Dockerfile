FROM php:8.2-apache AS build-php
RUN mount=type=cache,target='/usr/local/lib/php' \
    pecl install xdebug \
    && docker-php-ext-enable xdebug