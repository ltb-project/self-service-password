FROM php:7.2-apache
# Install PHP extensions and PECL modules.
RUN buildDeps=" \
        libbz2-dev \
        libsasl2-dev \
        libcurl4-gnutls-dev \
    " \
    runtimeDeps=" \
        curl \
        libicu-dev \
        libldap2-dev \
        libzip-dev \
    " \
    && apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y $buildDeps $runtimeDeps \
    && docker-php-ext-install bcmath bz2 iconv intl mbstring opcache curl \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap \
    && apt-get purge -y --auto-remove $buildDeps \
    && rm -r /var/lib/apt/lists/* \
    && a2enmod rewrite
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY . /var/www/html

EXPOSE 80

