# Usamos una imagen oficial de PHP con Apache
FROM php:7.4-apache

# Habilitamos los módulos necesarios de Apache (rewrite es comúnmente necesario)
RUN a2enmod rewrite

# Establecemos la carpeta 'public' como la raíz de Apache para servir los archivos desde ahí
WORKDIR /var/www/html

# Copiar todo el contenido del proyecto al contenedor
COPY . /var/www/html/

# Cambiar el DocumentRoot de Apache para que apunte a la carpeta 'public'
RUN sed -i 's|/var/www/html|/var/www/html/public|' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf
RUN echo '<Directory /var/www/html/public>' >> /etc/apache2/sites-available/000-default.conf
RUN echo '    AllowOverride All' >> /etc/apache2/sites-available/000-default.conf
RUN echo '    Require all granted' >> /etc/apache2/sites-available/000-default.conf
RUN echo '</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Instalar las extensiones de PHP necesarias (si las necesitas para tu DB)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Exponer el puerto 80 para que sea accesible desde fuera
EXPOSE 80

# Iniciar Apache cuando el contenedor se ejecute
CMD ["apache2-foreground"]
