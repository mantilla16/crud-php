# Usamos una imagen oficial de PHP
FROM php:7.4-apache

# Copiar el código al contenedor
COPY . /var/www/html/

# Instalar las dependencias de PHP si las necesitas (ejemplo: mysqli, pdo_mysql)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Exponer el puerto que se usará en el contenedor
EXPOSE 80
