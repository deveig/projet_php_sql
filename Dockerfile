FROM php:8.4-apache
WORKDIR /var/www/html/
COPY . .
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
WORKDIR /
RUN ( curl -sSLf https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - || echo 'return 1' ) | sh -s \ pdo_mysql