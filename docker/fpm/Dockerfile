FROM php:fpm

MAINTAINER Eder Soares

RUN apt-get update -y

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql

RUN pecl install redis
RUN docker-php-ext-enable redis
RUN rm -rf /tmp/pear

ENV XDEBUG_IDEKEY xdebug
ENV XDEBUG_REMOTE_HOST 127.0.0.1
ENV XDEBUG_REMOTE_PORT 9000
ENV XDEBUG_REMOTE_ENABLE 0

COPY php.ini /usr/local/etc/php/php.ini

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
