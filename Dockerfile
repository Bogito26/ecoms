# ------------ 1. BASE IMAGE (PHP + Apache) ------------
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# ------------ 2. INSTALL SYSTEM DEPENDENCIES ------------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libpng-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip mbstring exif pcntl bcmath

# ------------ 3. INSTALL COMPOSER ------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ------------ 4. COPY LARAVEL PROJECT ------------
WORKDIR /var/www/html

COPY . .

# ------------ 5. INSTALL DEPENDENCIES ------------
RUN composer install --no-dev --optimize-autoloader

# ------------ 6. SET PERMISSIONS ------------
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# ------------ 7. APACHE DOCUMENT ROOT ------------
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

# ------------ 8. OPTIMIZE LARAVEL ------------
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# ------------ 9. EXPOSE PORT 80 ------------
EXPOSE 80

# ------------ 10. START APACHE ------------
CMD ["apache2-foreground"]
