FROM php:8.1-fpm

RUN apt update && apt install -y gcc libpq-dev;
RUN docker-php-ext-install pdo_pgsql pgsql;