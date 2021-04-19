FROM php:8.0-apache
RUN docker-php-ext-install mysqli
# RUN groupadd uploader
# RUN usermod -a -G uploader www-data
# RUN usermod -a -G uploader root
# RUN chmod g+w /var/www/html/uploads
RUN chmod 777 /var/www/html/uploads
