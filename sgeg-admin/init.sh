#!/bin/sh

# Espera a que MySQL esté listo
while ! nc -z mysql 3306; do
  echo "Esperando a que MySQL esté disponible..."
  sleep 1
done

# Ejecuta migraciones y seeders
php artisan migrate --force
php artisan db:seed --force

# Inicia PHP-FPM
php-fpm
