# Set the base image for subsequent instructions
FROM php:7.4-fpm

# Update packages
RUN apt-get update

# Install PHP and composer dependencies
# Dependencies
RUN apt-get update \
    && apt-get install -y \
        libmcrypt-dev \
        libpq-dev \
        libicu-dev \
        libonig-dev \
        libpq-dev \
        zlib1g-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libjpeg-dev \
        libpng-dev \
        libmcrypt-dev \
        gnupg \
        vim \
        cron \
        imagemagick \
        locales \
        zip \
        unzip \
        git \
        supervisor \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Clear out the local repository of retrieved package files
RUN apt-get clean

RUN echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;

# Install needed extensions
# Here you can install any other extension that you need during the test and deployment process

RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install \
        intl \
        bcmath \
        gd \
        mysqli \
        mbstring \
        exif \
        opcache \
        pdo_mysql \
        json \
        pcntl

# Install Composer
RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel Envoy
RUN composer global require "laravel/envoy=~1.0"