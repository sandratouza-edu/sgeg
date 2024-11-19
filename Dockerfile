# php-fpm
FROM php:8.1-fpm

# dependencias 
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer


WORKDIR /var/www/html
COPY . .

# ILaravel
RUN composer install --no-scripts --no-autoloader && \
composer dump-autoload && \
php artisan key:generate

# Directorio subida 
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]

 