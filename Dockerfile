# Usar una imagen base de PHP con Apache
FROM php:7.4-apache

# Instalar la extensión mysqli
RUN docker-php-ext-install mysqli

# Habilitar mod_rewrite para URLs amigables
RUN a2enmod rewrite

# Establecer el directorio de trabajo en la carpeta 'Public'
WORKDIR /var/www/html/Public

# Copiar todo el proyecto al contenedor
COPY . /var/www/html/

# Exponer el puerto 80
EXPOSE 80
