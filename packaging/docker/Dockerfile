FROM php:8.2-apache
# Install PHP extensions and PECL modules.
ENV BUILDDEP=" \
        libbz2-dev \
        libsasl2-dev \
        libcurl4-gnutls-dev \
	libfreetype6-dev \
	libpng-dev \
	libjpeg62-turbo-dev \
	libwebp-dev \
        libonig-dev \
        git \
        zip \
    "
LABEL org.opencontainers.image.authors='LTB-project.org, ltb-dev@ow2.org' \
      org.opencontainers.image.base.name='docker.io/library/php:8.2-apache' \
      org.opencontainers.image.description='Self Service Password is a simple PHP application that allows users to change their password on an LDAP directory' \
      org.opencontainers.image.url='https://ltb-project.org/documentation/self-service-password.html' \
      org.opencontainers.image.ref.name='self-service-password' \
      org.opencontainers.image.documentation='https://self-service-password.readthedocs.io/' \
      org.opencontainers.image.title='self-service-password docker image' \
      org.opencontainers.image.source='https://github.com/ltb-project/self-service-password/' \
      org.opencontainers.image.vendor='LTB-project.org' \
      org.opencontainers.image.version='1.6.0' \
      org.opencontainers.image.licenses='GPL-2+'

RUN buildDeps="${BUILDDEP}" \
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
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap gd \
    && echo en_US.UTF-8 UTF-8 >/etc/locale.gen \
    && /usr/sbin/locale-gen \
    && a2enmod rewrite
RUN mkdir -p /usr/share/php/smarty4/ && \
    curl -Lqs https://github.com/smarty-php/smarty/archive/refs/tags/v4.4.1.tar.gz | \
    tar xzf - -C /usr/share/php/smarty4/ --strip-components=2
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY . /var/www
RUN rmdir /var/www/html && \
    mv /var/www/htdocs /var/www/html && \
    mkdir -p /var/www/templates_c && \
    chown -R www-data: /var/www/templates_c && \
    sed -i 's/smarty3/smarty4/' /var/www/conf/config.inc.php
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
RUN cd /var/www && /usr/bin/composer install
RUN buildDeps="${BUILDDEP}" \
    && apt-get purge -y --auto-remove $buildDeps \
    && rm -r /var/lib/apt/lists/*
ENV LC_CTYPE=en_US.UTF-8
EXPOSE 80

