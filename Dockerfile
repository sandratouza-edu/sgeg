FROM php:8.2-fpm-alpine

 
RUN apk update && apk add \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql \
    && apk --no-cache add nodejs npm



COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/

USER root

# Exponemos el puerto 9000 a la network
EXPOSE 9000

# da permisos para editar los archivos en esta ruta del container
RUN chown -R www-data:www-data /var/www
RUN chmod 755 /var/www

RUN chmod 777 -R /var/www/

