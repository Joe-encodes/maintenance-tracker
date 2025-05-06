# Base image with PHP and Composer
FROM php:8.2-cli

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip sqlite3 libsqlite3-dev && \
    docker-php-ext-install pdo pdo_sqlite

# Set working directory
WORKDIR /app

# Copy entire app BEFORE running Composer so artisan is available
COPY . .

# Install dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Ensure .env exists
RUN cp .env.example .env || true

# Ensure SQLite database exists
RUN mkdir -p database && touch database/database.sqlite

# Expose port
EXPOSE 8000

# Start Laravel app with SQLite migrations
CMD ["bash", "-c", "php artisan config:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]

