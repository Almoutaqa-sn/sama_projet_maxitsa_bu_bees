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

# Copier les fichiers du projet (sans .env)
COPY . /var/www/html/

# Installer les dépendances Composer
RUN composer install --no-dev --optimize-autoloader

# Configurer Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Donner les permissions appropriées
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exposer le port 80
EXPOSE 80

# Variables d'environnement par défaut (seront surchargées par Render)
# ENV DB_HOST=localhost
# ENV DB_PORT=5432
# ENV DB_NAME=sama_base_de_donnees
# ENV DB_USER=postgres
# ENV DB_PASSWORD=admin123
# ENV ENVIRONMENT=production

# Script de démarrage pour Nginx et PHP-FPM
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Démarrer Nginx et PHP-FPM
CMD ["/start.sh"]
