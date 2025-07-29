# Utiliser l'image officielle PHP-FPM
FROM php:8.2-fpm

# Installer Nginx et les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet
COPY . /var/www/html/

# S'assurer que le fichier .env est présent
COPY .env /var/www/html/.env 

# Installer les dépendances Composer
RUN composer install --no-dev --optimize-autoloader

# Configurer Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Donner les permissions appropriées
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exposer le port 80
EXPOSE 80

# Script de démarrage pour Nginx et PHP-FPM
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Démarrer Nginx et PHP-FPM
CMD ["/start.sh"]
