FROM php:8.3-fpm-alpine

RUN apk add --no-cache openssl bash mysql-client nodejs npm

# Install GD Dependencies
RUN apk add --no-cache freetype-dev libpng-dev libjpeg-turbo-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Install php extensions
RUN docker-php-ext-install -j "$(getconf _NPROCESSORS_ONLN)" pdo pdo_mysql opcache exif gd

# Install phpredis
RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS && pecl install redis && docker-php-ext-enable redis

# Remove dependencies
RUN apk del .phpize-deps

# Install Dockerize
ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Php.ini
COPY config/php.ini $PHP_INI_DIR/php.ini

# Copy opcache config
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"
COPY config/opcache.ini $PHP_INI_DIR/conf.d/

WORKDIR /var/www
RUN rm -rf /var/www/html

RUN ln -s public html

EXPOSE 9000
ENTRYPOINT ["php-fpm"]

