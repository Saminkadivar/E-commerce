FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy everything
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose the port Render assigns
EXPOSE 10000

# Run Laravel on Render’s port/host
CMD php artisan serve --host=0.0.0.0 --port=$PORT
