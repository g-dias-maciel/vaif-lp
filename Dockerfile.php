FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libmysqlclient-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /app

# Copy application files
COPY . .

# Set Apache document root
RUN sed -i 's|/var/www/html|/app/public|g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's|/var/www/html|/app/public|g' /etc/apache2/apache2.conf

# Create .htaccess for routing
RUN echo '<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php?path=$1 [QSA,L]
</IfModule>' > /app/public/.htaccess

# Set permissions
RUN chown -R www-data:www-data /app

# Expose port
EXPOSE 8000

# Start Apache
CMD ["apache2-foreground"]
