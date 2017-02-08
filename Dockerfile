FROM php:5.6-apache
RUN apt-get update \
&& docker-php-ext-install pdo pdo_mysql
