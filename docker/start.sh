#!/bin/sh

# Use the PORT environment variable provided by Render, or default to 80 if not set
PORT=${PORT:-80}

if [ -z "${APP_KEY:-}" ]; then
	echo "ERROR: APP_KEY must be configured in the Render environment."
	exit 1
fi

# Render runs behind HTTPS and may retain old session settings between deploys.
export SESSION_DRIVER=cookie
export SESSION_SECURE_COOKIE=true
export SESSION_COOKIE=kuroko_session
export LOG_CHANNEL=${LOG_CHANNEL:-stderr}

# Update Nginx config to listen on the dynamic port
sed -i "s/listen 80;/listen ${PORT};/g" /etc/nginx/http.d/default.conf

# Asegurar directorios de almacenamiento y permisos para el usuario www-data
mkdir -p /var/www/html/storage/logs \
         /var/www/html/storage/framework/cache/data \
         /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/views \
         /var/www/html/bootstrap/cache \
         /var/www/html/database

touch /var/www/html/database/database.sqlite
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
chmod 664 /var/www/html/database/database.sqlite

# Validar conectividad de base de datos PostgreSQL
if [ "${DB_CONNECTION:-}" = "pgsql" ] || [ -n "${DATABASE_URL:-}" ]; then
    echo "Verificando conexión con PostgreSQL..."
    if ! php -r '
        $conn = getenv("DB_CONNECTION") ?: "pgsql";
        $host = trim(getenv("DB_HOST") ?: "127.0.0.1");
        $port = trim(getenv("DB_PORT") ?: "5432");
        $db   = trim(getenv("DB_DATABASE") ?: "kuroko_db");
        $user = trim(getenv("DB_USERNAME") ?: "postgres");
        $pass = getenv("DB_PASSWORD") ?: "";
        $url  = getenv("DB_URL") ?: getenv("DATABASE_URL");
        if ($url) {
            $parsed = parse_url($url);
            $host = $parsed["host"] ?? $host;
            $port = $parsed["port"] ?? $port;
            $user = $parsed["user"] ?? $user;
            $pass = $parsed["pass"] ?? $pass;
            if (isset($parsed["path"])) {
                $db = ltrim($parsed["path"], "/");
            }
        }
        $ip = gethostbyname($host);
        if ($ip === $host && !filter_var($host, FILTER_VALIDATE_IP)) {
            fwrite(STDERR, "AVISO: El host PostgreSQL \"$host\" no se puede resolver en DNS (Name does not resolve).\n");
            exit(1);
        }
        try {
            $dsn = "pgsql:host=$host;port=$port;dbname=$db;connect_timeout=3";
            $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_TIMEOUT => 3]);
        } catch (Throwable $e) {
            fwrite(STDERR, "AVISO: No se pudo conectar a PostgreSQL: " . $e->getMessage() . "\n");
            exit(1);
        }
    '; then
        echo "------------------------------------------------------------------"
        echo "ADVERTENCIA: La conexión a PostgreSQL falló."
        echo "Activando base de datos SQLite de respaldo para evitar caída del servidor (500)."
        echo "Todas las rutas seguirán funcionando normalmente en el servidor desplegado."
        echo "------------------------------------------------------------------"
        export DB_CONNECTION=sqlite
        export DB_DATABASE=/var/www/html/database/database.sqlite
    else
        echo "Conexión a PostgreSQL establecida exitosamente."
    fi
fi

# Configurar caché para optimizar el rendimiento en producción
echo "Cacheando configuraciones de Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ejecutar las migraciones pendientes forzosamente
echo "Ejecutando migraciones..."
php artisan migrate --force

# Volver a asignar permisos correctos tras ejecutar artisan como root
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Iniciar PHP-FPM en segundo plano
echo "Iniciando PHP-FPM..."
php-fpm -D

# Iniciar Nginx en primer plano
echo "Iniciando Nginx..."
nginx -g "daemon off;"
