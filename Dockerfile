# ==========================================
# Etapa 1: Compilación de Node.js (Vite)
# ==========================================
FROM node:20-alpine as frontend

WORKDIR /app
COPY package*.json ./
RUN npm ci

# Copiamos todo excepto lo que está en .dockerignore
COPY . .
RUN npm run build

# ==========================================
# Etapa 2: Entorno de PHP y Nginx
# ==========================================
FROM php:8.2-fpm-alpine

# Instalar dependencias del sistema y de PHP (incluye pdo_pgsql e intl)
RUN apk add --no-cache \
    nginx \
    postgresql-dev \
    icu-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    bash

# Instalar extensiones necesarias de PHP para Laravel y PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql pgsql intl zip bcmath

# Copiar Composer desde la imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos de la aplicación
COPY . .

# Create the default SQLite database when PostgreSQL is not configured.
RUN mkdir -p database \
    && touch database/database.sqlite

# Copiar los assets compilados de la Etapa 1
COPY --from=frontend /app/public/build public/build

# Instalar las dependencias de PHP (sin dev, optimizado)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Asignar los permisos correctos a las carpetas de almacenamiento y caché de Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod 664 /var/www/html/database/database.sqlite

# Copiar configuración de Nginx y script de arranque
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/start.sh /usr/local/bin/start.sh

# Dar permisos de ejecución al script de inicio
RUN chmod +x /usr/local/bin/start.sh

# Exponer el puerto web 80 (usado por Nginx)
EXPOSE 80

# Punto de entrada al ejecutar el contenedor
ENTRYPOINT ["/usr/local/bin/start.sh"]
