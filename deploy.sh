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

# Asignar permisos y propietario a storage y bootstrap/cache
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Verificar y crear el enlace simbólico para public/storage
if [ ! -L "public/storage" ]; then
    echo "Creando enlace simbólico para public/storage..."
    php artisan storage:link
fi

# Configurar permisos para public/storage
echo "Configurando permisos para public/storage..."
chmod -R 775 public/storage
chown -R www-data:www-data public/storage

echo "Permisos configurados correctamente."

# Paso 5: Iniciar el servidor
echo "Iniciando el servidor Laravel..."
php artisan serve 

echo "Despliegue completado con éxito."
