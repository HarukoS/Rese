FROM php:8.1-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y \
    default-mysql-client \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libxpm-dev \
  && docker-php-ext-configure gd \
    --with-freetype --with-jpeg --with-webp --with-xpm \
  && docker-php-ext-install -j$(nproc) gd pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

WORKDIR /var/www