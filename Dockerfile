FROM php:8.4-apache
WORKDIR /usr/local/etc/php/
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
WORKDIR /
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'c8b085408188070d5f52bcfe4ecfbee5f727afa458b2573b8eaaf77b3419b0bf2768dc67c86944da1544f06fa544fd47') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');" 
RUN mv composer.phar /usr/local/bin/composer
RUN ( curl -sSLf https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - || echo 'return 1' ) | sh -s \ zip pdo_mysql
WORKDIR /var/www/html/
ARG DB_URL
ARG DB_USERNAME
ARG DB_PASSWORD
ENV DB_URL=$DB_URL
ENV DB_USERNAME=$DB_USERNAME
ENV DB_PASSWORD=$DB_PASSWORD
RUN composer require vlucas/phpdotenv
COPY . .
RUN composer install