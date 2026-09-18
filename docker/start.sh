#!/bin/sh

# Use the PORT environment variable provided by Render, or default to 80 if not set
PORT=${PORT:-80}

if [ -z "${APP_KEY:-}" ]; then
	echo "ERROR: APP_KEY must be configured in the Render environment."
	exit 1
fi

# Render runs behind HTTPS and may retain old session settings between deploys.
export SESSION_DRIVER=file
export SESSION_SECURE_COOKIE=true
export SESSION_COOKIE=kuroko_session

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
