# syntax=docker/dockerfile:1

# Usage:
#
# docker build -t usvn .
#
# docker run -d -p 9000:80 --name usvn-server \
#   -v /path/to/files:/var/www/html/files \
#   -v /path/to/config:/var/www/html/config usvn

FROM php:8.2-apache-buster

RUN apt-get update && apt-get install -y libapache2-mod-svn subversion
RUN a2enmod dav && a2enmod dav_fs && a2enmod rewrite && a2enmod authz_svn && a2enmod dav_svn

COPY ./src /var/www/html

COPY svn-apache.conf /etc/apache2/sites-enabled/000-default.conf

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN chmod a+rwx /var/www/html/files
RUN chown -R www-data:www-data /var/www/

EXPOSE 80
VOLUME /var/www/html/files
VOLUME /var/www/html/config

# USER www-data
