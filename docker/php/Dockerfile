FROM php:7.4.9-fpm

COPY php.ini /usr/local/etc/php/

#SSL証明書のディレクトリを作成
RUN mkdir -p /etc/ssl/certs /etc/ssl/private

COPY ssl/server.crt /etc/ssl/certs/
COPY ssl/server.key /etc/ssl/private/

RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && docker-php-ext-install pdo_mysql zip \
  && apt clean \
  && rm -rf /var/lib/apt/lists \*

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

WORKDIR /var/www