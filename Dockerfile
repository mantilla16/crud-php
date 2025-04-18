# Usamos una imagen oficial de PHP con Apache
FROM php:7.4-apache

# Habilitamos los módulos necesarios de Apache (si los necesitas)
RUN a2enmod rewrite

# Establecemos la carpeta 'public' como la raíz de Apache
WORKDIR /var/www/html

# Copiar todo el contenido del proyecto al contenedor
COPY . /var/www/html/

# Cambiar el directorio raíz de Apache a 'public' (para que sirva los archivos desde ahí)
RUN echo 'DocumentRoot /var/www/html/public' >> /etc/apache2/sites-available/000-default.conf
RUN echo '<Directory /var/www/html/public>' >> /etc/apache2/sites-available/000-default.conf
RUN echo '    AllowOverride All' >> /etc/apache2/sites-available/000-default.conf
RUN echo '    Require all granted' >> /etc/apache2/sites-available/000-default.conf
RUN echo '</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Instalar las extensiones de PHP necesarias (si las necesitas)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Exponer el puerto 80 para que sea accesible desde fuera
EXPOSE 80
