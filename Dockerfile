# Sử dụng PHP 8.2 FPM Alpine để giảm kích thước image
FROM php:8.2-fpm-alpine

# Cài đặt các dependencies cần thiết
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    oniguruma-dev \
    mysql-client \
    libzip-dev

# Cài đặt PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy source code
COPY . /var/www

# Copy .env.example nếu .env chưa tồn tại
RUN if [ ! -f .env ]; then cp .env.docker .env; fi

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Expose port 9000 cho PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
