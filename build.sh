#!/bin/bash

# Install dependencies
composer install --no-dev --optimize-autoloader

# Set proper permissions
chmod -R 775 storage bootstrap/cache

# Create storage link if not exists
php artisan storage:link

# Clear and cache config for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force
