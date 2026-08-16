FROM dunglas/frankenphp:php8.4-bookworm

# Extensions PHP nécessaires à Laravel
RUN install-php-extensions \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    intl \
    zip

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer Node.js + npm
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

WORKDIR /app

# Copier le projet
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Installer les dépendances JS et compiler Vite
RUN npm install
RUN npm run build

# Permissions Laravel
RUN chown -R www-data:www-data storage bootstrap/cache
RUN setcap -r /usr/local/bin/frankenphp

# Port utilisé par Render
EXPOSE 10000

# Lancer Laravel
CMD ["frankenphp", "php-server", "--root", "public", "--listen", ":10000"]
