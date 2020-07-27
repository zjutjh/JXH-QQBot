FROM php:7.4.8-fpm

WORKDIR /var/www/html

RUN pecl install redis-5.0.0 && docker-php-ext-enable redis

# opcache 扩展
RUN docker-php-ext-configure opcache --enable-opcache && docker-php-ext-install opcache

RUN docker-php-ext-install pdo pdo_mysql bcmath


