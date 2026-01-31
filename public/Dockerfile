FROM php:8.2-apache

# Habilitar extensiones necesarias para PostgreSQL (Supabase)
RUN docker-php-ext-install pdo pdo_pgsql

# Habilitar mod_rewrite (opcional pero recomendado)
RUN a2enmod rewrite

# Copiar el proyecto al contenedor
COPY . /var/www/html/

# Permisos correctos
RUN chown -R www-data:www-data /var/www/html

# Puerto que usará Render
EXPOSE 80
