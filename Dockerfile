FROM php:7-apache
ARG MYSQL_DATABASE_HOST=$DB_SERVER
ARG MYSQL_DATABASE_NAME=$DB_DATABASE
ARG MYSQL_DATABASE_USER=$DB_USERNAME
ARG MYSQL_DATABASE_USER_PASSWORD=$DB_PASSWORD
RUN apt-get update \
    && a2enmod rewrite \
    && docker-php-ext-install mysqli \
    && apt-get install -y iputils-ping \
    && apt-get autoremove -y
COPY . /var/www/html
WORKDIR /var/www/html
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
# add php error log