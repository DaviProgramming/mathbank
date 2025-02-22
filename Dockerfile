# Use a imagem base do PHP
FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    postgresql-client \
    libpq-dev

# Instalar extensão do PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN composer clear-cache

RUN composer install --prefer-dist --no-scripts --optimize-autoloader

COPY . .

EXPOSE 8000

RUN chmod -R 777 storage bootstrap/cache

# Criando um script de inicialização
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
