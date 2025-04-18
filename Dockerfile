# Usar una imagen base de PHP con Apache
FROM php:7.4-apache

# Habilitar mod_rewrite para URLs amigables
RUN a2enmod rewrite

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar todo el proyecto al contenedor
COPY . /var/www/html/

# Exponer el puerto 80
EXPOSE 80
