FROM php:8.1-fpm

COPY ./docker/php/php.ini /usr/local/etc/php/

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
    cron \
    procps \
  && docker-php-ext-configure gd \
    --with-freetype --with-jpeg --with-webp --with-xpm \
  && docker-php-ext-install -j$(nproc) gd pdo_mysql zip

COPY ./docker/crontab /etc/cron.d/laravel-cron

RUN chmod 0644 /etc/cron.d/laravel-cron
RUN touch /var/log/cron.log

COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /var/www

ENTRYPOINT ["docker-entrypoint.sh"]