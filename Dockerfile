FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libsqlite3-dev \
    git \
    && docker-php-ext-install zip pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/storage && chmod 775 /var/www/html/storage

RUN mkdir -p /var/www/html/database && touch /var/www/html/database/database.sqlite
RUN chown -R www-data:www-data /var/www/html/database && chmod 775 /var/www/html/database/database.sqlite

WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

EXPOSE 80

ENTRYPOINT ["bash", "-c", "apache2-foreground"]



