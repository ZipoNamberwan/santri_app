FROM php:7.4-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    git \
    bash \
    mysql-client

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) \
    gd \
    mysqli \
    pdo \
    pdo_mysql \
    exif \
    bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create PHP configuration to suppress deprecation warnings for CodeIgniter 3 compatibility
RUN echo "error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT" > /usr/local/etc/php/conf.d/codeigniter-compat.ini

# Copy application code
COPY . /var/www/html

# Create necessary directories
RUN mkdir -p /var/www/html/application/cache/sessions && \
    mkdir -p /var/www/html/application/logs && \
    mkdir -p /var/www/html/assets/file_tmp/tiket && \
    mkdir -p /var/www/html/assets/file_tmp/rekap && \
    chown -R www-data:www-data /var/www/html/application/cache && \
    chown -R www-data:www-data /var/www/html/application/logs && \
    chown -R www-data:www-data /var/www/html/assets/file_tmp && \
    chmod -R 755 /var/www/html/application/cache && \
    chmod -R 755 /var/www/html/application/logs && \
    chmod -R 755 /var/www/html/assets/file_tmp && \
    chmod -R u+w /var/www/html/application/cache && \
    chmod -R u+w /var/www/html/application/logs && \
    chmod -R u+w /var/www/html/assets/file_tmp

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port for PHP-FPM
EXPOSE 9000

# Set entrypoint
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

# Start PHP-FPM
CMD ["php-fpm"]
