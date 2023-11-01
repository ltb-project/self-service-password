FROM php:8.1-apache
# Install PHP extensions and PECL modules.
RUN buildDeps=" \
        libbz2-dev \
        libsasl2-dev \
        libcurl4-gnutls-dev \
	libfreetype6-dev \
	libpng-dev \
	libjpeg62-turbo-dev \
	libwebp-dev \
        libonig-dev \
    " \
    runtimeDeps=" \
        curl \
        libicu-dev \
        libldap-common \
        libldap2-dev \
	libgd3 \
	libjpeg62-turbo \
	libpng16-16 \
	libwebp7 \
        libzip-dev \
	locales \
	locales-all \
	sendmail \
    " \
    && apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y $buildDeps $runtimeDeps \
    && docker-php-ext-install bcmath bz2 iconv intl mbstring opcache curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-configure ldap \
    && docker-php-ext-install ldap gd \
    && echo en_US.UTF-8 UTF-8 >/etc/locale.gen \
    && /usr/sbin/locale-gen \
    && apt-get purge -y --auto-remove $buildDeps \
    && rm -r /var/lib/apt/lists/* \
    && a2enmod rewrite
RUN mkdir -p /usr/share/php/smarty4/ && \
    curl -Lqs https://github.com/smarty-php/smarty/archive/refs/tags/v4.2.0.tar.gz | \
    tar xzf - -C /usr/share/php/smarty4/ --strip-components=2
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY . /var/www
RUN rmdir /var/www/html && \
    mv /var/www/htdocs /var/www/html && \
    mkdir -p /var/www/templates_c && \
    chown -R www-data: /var/www/templates_c && \
    sed -i 's/smarty3/smarty4/' /var/www/conf/config.inc.php
ENV LC_CTYPE=en_US.UTF-8
EXPOSE 80

