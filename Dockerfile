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

# Apache Rewrite Module চালু করা (Laravel routes এর জন্য)
RUN a2enmod rewrite

# Document root পরিবর্তন করে public ফোল্ডারে সেট করা
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html
COPY . /var/www/html

# Composer ইনস্টল
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 80