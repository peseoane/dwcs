FROM php:8.3-apache AS build-php
WORKDIR /var/www/html

RUN --mount=type=cache,target=/var/cache/apt apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    wget \
    git \
    unzip \
    libsodium-dev

RUN mount=type=cache,target='/usr/local/lib/php' && pecl install xdebug zlib && pecl enable xdebug zlib
RUN docker-php-ext-install zip pdo pdo_mysql mysqli sodium && docker-php-ext-enable zip sodium pdo pdo_mysql mysqli
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN ln -s /root/.composer/vendor/bin/leaf /usr/local/bin/leaf

RUN --mount=type=cache,target=/var/cache/apt apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/* \

WORKDIR /var/www
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www
# COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite headers

RUN echo "zend_extension=xdebug" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "xdebug.discover_client_host = 1" >> /usr/local/etc/php/conf.d/xdebug.ini
#RUN echo "zlib.output_compression = On" >> /usr/local/etc/php/conf.d/docker-php-ext-zlib.ini
#RUN echo "zlib.output_compression_level = 9" >> /usr/local/etc/php/conf.d/docker-php-ext-zlib.ini
#RUN echo "zlib.output_handler = ob_gzhandler" >> /usr/local/etc/php/conf.d/docker-php-ext-zlib.ini
WORKDIR /var/www/html/

RUN groupadd -g 1000 alumno
RUN useradd -m -u 1000 -g 1000 alumno
RUN chown -R alumno:alumno /var/www/html
USER alumno

# RUN composer require leafs/cli leafs/devtools
ENV PATH="/var/www/html/vendor/bin:${PATH}"