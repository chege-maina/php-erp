FROM php:8.0-apache
RUN docker-php-ext-install mysqli
# RUN chown nobody /tmp/
# RUN chown nobody /var/www/html/uploads/
# RUN chown -R 755 /tmp/
# RUN chown -R 755 /var/www/html/uploads/
# RUN chown -Rf www-data:www-data /var/www/html/*
# RUN chown -R www-data:www-data /tmp
RUN chown a+rwxt /var/www/html/uploads
