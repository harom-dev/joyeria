FROM php:8.2-apache

# Desactivar otros MPMs
RUN a2dismod mpm_event mpm_worker || true
RUN a2enmod mpm_prefork

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Instalar PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copiar el proyecto
COPY . /var/www/html/

# Permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
