FROM php:7.4-cli
VOLUME [ "/var/www" ]
WORKDIR /var/www
RUN apt-get update && \
  apt-get install -y libpq-dev && \
  docker-php-ext-install pdo pdo_pgsql
CMD [ "php", "-S", "0.0.0.0:8000", "-t", "public/" ]
