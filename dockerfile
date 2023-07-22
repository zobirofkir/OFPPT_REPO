FROM php:8.0-apache

WORKDIR /var/www/html

COPY . /var/www/html

# Install PHP dependencies (if any) using Composer
# Uncomment the following lines if you use Composer
# RUN apt-get update && apt-get install -y unzip
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN composer install

EXPOSE 80

CMD ["apache2-foreground"]
