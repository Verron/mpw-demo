FROM php:8.3-fpm-alpine3.18 AS base

# Install dependencies
RUN apk upgrade --update && \
    apk add --no-cache \
    nginx \
    $PHPIZE_DEPS \
    openssl-dev \
    ;

RUN pecl install mongodb-1.17.2 && \
    docker-php-ext-enable mongodb

RUN docker-php-ext-install \
    opcache \
    ;

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN  chown www-data:www-data /srv

USER root

WORKDIR /srv


FROM base AS app

COPY ops/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ops/nginx/default.conf /etc/nginx/conf.d/default.conf
#COPY ops/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY ops/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

COPY ./composer.json ./composer.lock ./symfony.lock ./

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV APP_ENV=prod

RUN composer install --no-dev --no-scripts --no-progress --no-suggest; \
    composer clear-cache

COPY .env ./
COPY bin bin/
COPY config config/
COPY public public/
COPY src src/

RUN composer dump-env prod; \
    composer run-script --no-dev post-install-cmd; \
    composer run-script --no-dev post-update-cmd; \
    composer dump-autoload --classmap-authoritative --no-dev; \
    composer clear-cache; \
    chmod +x bin/console;

COPY ops/entrypoint /usr/local/bin
RUN chmod +x /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]
CMD ["php-fpm"]

