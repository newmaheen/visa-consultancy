FROM php:8.2-apache

# Proyojoniyo system library ebong PHP extension install
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Apache Rewrite Module on kora
RUN a2enmod rewrite

# Document root public folder-e set kora
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

# Composer binary copy kora
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Project files copy kora
COPY . /var/www/html

# Composer dependencies install kora
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Filament CSS ebong JS assets public folder-e publish kora
RUN php artisan filament:assets || true
RUN php artisan filament:optimize || true

# Storage symbolic link toiri kora
RUN php artisan storage:link

# Storage ebong bootstrap cache folder permission thik kora
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80