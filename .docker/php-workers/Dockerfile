FROM php:8.3-fpm-alpine

RUN apk add --no-cache mysql-client

# Install GD Dependencies
RUN apk add --no-cache freetype-dev libpng-dev libjpeg-turbo-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Install php extensions
RUN docker-php-ext-install -j "$(getconf _NPROCESSORS_ONLN)" pdo pdo_mysql opcache exif gd

#Entrypoint to workers
COPY ./entrypoint-cronworker.sh /usr/local/bin/entrypoint-cronworker

RUN chmod u+x /usr/local/bin/entrypoint-cronworker

# Install phpredis
RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS && pecl install redis && docker-php-ext-enable redis
