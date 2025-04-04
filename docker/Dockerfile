FROM php:8.4-fpm-alpine

# Install system dependencies and PHP extensions
RUN apk update && apk add --no-cache \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    postgresql-dev \
    oniguruma-dev \
    bash \
    git \
    unzip \
    pkgconf  # Added pkgconf to help locate libraries

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY .. .

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev

# Set correct permissions for storage and bootstrap/cache after copying files
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Ensure proper directory permissions for Laravel's storage and cache folders
RUN chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
