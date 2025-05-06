# Base image with PHP and Composer
FROM php:8.2-cli

# Set working directory
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip sqlite3 libsqlite3-dev curl && \
    docker-php-ext-install pdo pdo_sqlite

# Install Node.js version 18
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Install npm version 9 (ensure it's the version you need)
RUN npm install -g npm@9

# Install frontend dependencies
COPY package.json package-lock.json ./
RUN npm install --legacy-peer-deps

# Build frontend assets with Vite
RUN npm run build

# Install Composer and project dependencies
COPY . .
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Ensure SQLite database exists
RUN mkdir -p database && touch database/database.sqlite

# Expose port
EXPOSE 8000

# Start Laravel app with SQLite migrations
CMD ["bash", "-c", "php artisan config:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]
