FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libreoffice \
    libreoffice-writer \
    fonts-dejavu \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Samakan user dengan host (UID 1000)
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

RUN chown -R www-data:www-data /var/www

RUN echo "upload_max_filesize=100M" >> /usr/local/etc/php/conf.d/uploads.ini
RUN echo "post_max_size=100M" >> /usr/local/etc/php/conf.d/uploads.ini

USER www-data