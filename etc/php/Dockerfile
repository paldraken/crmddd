FROM php:8.0-fpm

RUN apt-get update
RUN apt-get install -y \
        curl \
        git \
        libpq-dev \
        libzip-dev zip unzip;

RUN docker-php-ext-install pdo_pgsql sockets


RUN pecl install xdebug-3.0.4 \
    && docker-php-ext-enable xdebug;

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

RUN rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

user ${PUID}

WORKDIR /app