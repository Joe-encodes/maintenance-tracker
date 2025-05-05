# Stage 1: Base Composer Build
FROM composer:2.7 AS composer

WORKDIR /app

# Copy entire app for artisan + discovery
COPY . .

RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader


# Stage 2: PHP Runtime
FROM php:8.2-cli

# Install dependencies (adjust as needed)
RUN apt-get update && apt-get install -y \
    sqlite3 libsqlite3-dev unzip libzip-dev curl git \
    && docker-php-ext-install pdo pdo_sqlite zip

WORKDIR /app

COPY --from=composer /app /app

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
