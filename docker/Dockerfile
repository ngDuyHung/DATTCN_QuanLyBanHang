FROM php:8.2-fpm

# ── System dependencies ──
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql mbstring exif pcntl bcmath gd zip intl opcache \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ── Composer ──
COPY --from=composer:2 /usr/local/bin/composer /usr/local/bin/composer

# ── PHP config tối ưu ──
RUN echo "opcache.enable=1\n\
opcache.memory_consumption=128\n\
opcache.interned_strings_buffer=8\n\
opcache.max_accelerated_files=10000\n\
opcache.validate_timestamps=1\n\
opcache.revalidate_freq=2" > /usr/local/etc/php/conf.d/opcache.ini

# ── Working directory ──
WORKDIR /var/www/html

# ── Copy composer files first for better layer caching ──
COPY composer.json composer.lock* ./
RUN composer install --no-scripts --no-autoloader --prefer-dist

# ── Copy source code ──
COPY . .

# ── Finalize composer ──
RUN composer dump-autoload --optimize

# ── Permissions ──
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
