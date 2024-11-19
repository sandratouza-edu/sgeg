# php-fpm
FROM php:8.1-fpm

# dependencias 
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql zip bcmath \
    && apk --no-cache add nodejs npm
 
# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


WORKDIR /var/www/html
COPY ./sgeg /var/www/html

# Directorio subida 
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

ENV COMPOSER_HOME=/var/www/.composer

# ILaravel
 RUN composer install --no-dev --no-scripts --no-autoloader  
 RUN composer dump-autoload && \
 php artisan key:generate

#RUN php artisan config:cache && \
#    php artisan route:cache

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

EXPOSE 9000

CMD ["php-fpm"]

 
