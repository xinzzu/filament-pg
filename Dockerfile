# Gunakan image PHP 8.2 dengan FPM sebagai dasar
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependensi sistem dan ekstensi PHP yang dibutuhkan Laravel
# Termasuk dependensi untuk zip dan intl
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    libzip-dev \
    libicu-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets ctype zip intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin file proyek
COPY . .

# Install dependensi Composer (hanya sekali)
RUN composer install --optimize-autoloader --no-dev

# Atur izin folder setelah vendor diinstal
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Salin file konfigurasi
COPY ./docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/sites-available/default
COPY ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

# Buat direktori untuk socket dan atur izinnya
RUN mkdir -p /var/run/php-fpm
RUN chown -R www-data:www-data /var/run/php-fpm

# Expose port 80 untuk Nginx
EXPOSE 80

# Perintah untuk menjalankan supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
