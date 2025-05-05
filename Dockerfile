# Stage 1: Composer Dependencies
FROM composer:2.7 AS composer

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Stage 2: App Base
FROM php:8.2-fpm

# System deps
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    sqlite3 \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Node for asset compilation (optional)
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt install -y nodejs

# PHP config
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
COPY . .

# Laravel permissions
RUN chmod -R 775 storage bootstrap/cache

# Run Laravel-specific optimizations
RUN composer dump-autoload --optimize && php artisan config:cache && php artisan route:cache

# Default PHP-FPM entrypoint
CMD ["php-fpm"]
