FROM php:8.1.2-fpm

RUN apt-get update -y && apt-get install -y openssl zip unzip git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN CFLAGS="$CFLAGS -D_GNU_SOURCE" docker-php-ext-install sockets

WORKDIR /app

COPY . .

RUN composer update && composer install

CMD php artisan serve --host=0.0.0.0 

EXPOSE 8000