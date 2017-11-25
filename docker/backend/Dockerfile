FROM php:7-fpm-alpine

RUN apk add --update bash \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && rm -rf /var/cache/apk/* \
    && curl -sS https://getcomposer.org/installer | php \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer

COPY docker-entrypoint.sh /usr/local/bin/docker-php-entrypoint
