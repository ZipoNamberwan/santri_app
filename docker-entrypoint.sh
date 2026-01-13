#!/bin/sh
set -e

# Fix permissions for writable directories
chown -R www-data:www-data /var/www/html/application/cache
chown -R www-data:www-data /var/www/html/application/logs
chown -R www-data:www-data /var/www/html/assets/file_tmp

chmod -R 755 /var/www/html/application/cache
chmod -R 755 /var/www/html/application/logs
chmod -R 755 /var/www/html/assets/file_tmp

# Allow write permissions
chmod -R u+w /var/www/html/application/cache
chmod -R u+w /var/www/html/application/logs
chmod -R u+w /var/www/html/assets/file_tmp

# Execute PHP-FPM
exec "$@"
