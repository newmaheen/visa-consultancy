FROM php:8.2-apache

# প্রয়োজনীয় সিস্টেম লাইব্রেরি এবং পিএইচপি এক্সটেনশন ইনস্টল
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

# Apache Rewrite Module চালু করা
RUN a2enmod rewrite

# Document root পরিবর্তন করে public ফোল্ডারে সেট করা
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

# Composer বাইনারি আনা
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# প্রজেক্ট ফাইল কপি করা
COPY . /var/www/html

# PHP File Upload এবং Post Size লিমিট বাড়ানো (64MB করা হলো)
RUN echo "upload_max_filesize = 64M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 64M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/uploads.ini

# ডিপেনডেন্সি ইনস্টল করা
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Filament এর CSS এবং JS অ্যাসেট পাবলিশ করা
RUN php artisan filament:assets || true
RUN php artisan filament:optimize || true

# স্টোরেজ সিম্বলিক লিংক তৈরি করা
RUN php artisan storage:link

# স্টোরেজ এবং বুটস্ট্র্যাপ ক্যাশ ফোল্ডারের পারমিশন ঠিক করা
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80