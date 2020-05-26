FROM php:7.4-cli
VOLUME [ "/var/www" ]
WORKDIR /var/www
CMD [ "php", "-S", "0.0.0.0:8000", "-t", "public/" ]
