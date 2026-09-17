#!/bin/sh

# Use the PORT environment variable provided by Render, or default to 80 if not set
PORT=${PORT:-80}

# Update Nginx config to listen on the dynamic port
sed -i "s/listen 80;/listen ${PORT};/g" /etc/nginx/http.d/default.conf

# Configurar caché para optimizar el rendimiento en producción
echo "Cacheando configuraciones de Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ejecutar las migraciones pendientes forzosamente (requerido para producción)
echo "Ejecutando migraciones..."
php artisan migrate --force

# Iniciar PHP-FPM en segundo plano
echo "Iniciando PHP-FPM..."
php-fpm -D

# Iniciar Nginx en primer plano
echo "Iniciando Nginx..."
nginx -g "daemon off;"
