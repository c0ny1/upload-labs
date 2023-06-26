FROM php:4.4-apache

ENV LC_ALL C.UTF-8
ENV TZ Asia/Ho_Chi_Minh

COPY . /tmp/

# config apache && php
RUN cp /tmp/docker-php.conf /etc/apache2/conf-available/docker-php.conf && \
    cp /tmp/php.ini /usr/local/etc/php/ && \
    cp /tmp/php.ini /usr/local/etc/php/conf.d/

# install git && php ext
RUN apt-get update && \
    apt-get install -y libgd-dev git && \
    docker-php-ext-install gd exif

# install upload-labs
RUN cd /tmp/ && \
    git clone https://github.com/namhikelo/upload-labs.git && \
    rm -rf /var/www/html/* && \
    mv /tmp/upload-labs/* /var/www/html/ && \
    chown www-data:www-data -R /var/www/html/ && \
    rm -rf /tmp/*

EXPOSE 80
