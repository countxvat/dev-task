FROM php:8.1-fpm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN  apt-get update -my && apt-get install -y \
        libzip-dev \
        zip \
        git
RUN docker-php-ext-install zip


RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN docker-php-ext-install -j$(nproc) pdo_mysql
WORKDIR /usr/src/dev-task
