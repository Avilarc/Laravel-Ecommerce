#!/bin/bash

# Paso 1: Instalar dependencias con Composer
echo "Instalando dependencias con Composer..."
composer install --no-interaction --prefer-dist --optimize-autoloader

# Paso 2: Configurar el archivo .env
echo "Configurando el archivo .env..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Archivo .env creado a partir de .env.example"
else
    echo "El archivo .env ya existe"
fi

# Generar la clave de aplicación
echo "Generando la clave de aplicación..."
php artisan key:generate

# Paso 3: Ejecutar migraciones y seeders
echo "Ejecutando migraciones y seeders..."
php artisan migrate 
php artisan db:seed 

# Paso 4: Configurar permisos adecuados
echo "Configurando permisos para storage y bootstrap/cache..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Paso 5: Iniciar el servidor
echo "Iniciando el servidor Laravel..."
php artisan serve 

echo "Despliegue completado con éxito."
