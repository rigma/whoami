FROM composer:latest AS build
WORKDIR /usr/src
COPY composer.json composer.lock ./
RUN composer install -o -n --no-scripts

FROM php:7.4-cli
ENV APP_PORT 8000
ENV DB_HOST locahost
ENV DB_PORT 5432
WORKDIR /var/www
RUN apt-get update && \
  apt-get install -y libpq-dev && \
  docker-php-ext-install pdo pdo_pgsql
COPY bin ./bin
COPY config ./config
COPY public ./public
COPY src ./src
COPY --from=build /usr/src/vendor ./vendor
COPY .env wait-for-it.sh docker-entrypoint.sh ./
RUN chmod +x wait-for-it.sh docker-entrypoint.sh
CMD [ "./wait-for-it.sh", "-t", "5",  "${DB_HOST}:${DB_PORT}", "--", "./docker-entrypoint.sh" ]
