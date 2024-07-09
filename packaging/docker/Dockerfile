FROM php:8.2-fpm-alpine

ENV BUILDDEP=" \
        php-apache2 \
        php-ldap \
        php-gd \
        php-iconv \
        php-mbstring \
        bash \
        bzip2-dev \
        icu-dev \
        oniguruma-dev \
        libldap \
        openldap-dev \
        curl \
        curl-dev \
        libpng-dev \
        libwebp-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        openrc \
        apache2 \
        ca-certificates \
    "
LABEL org.opencontainers.image.authors='LTB-project.org, ltb-dev@ow2.org' \
      org.opencontainers.image.base.name='docker.io/library/php:8.2-fpm-alpine' \
      org.opencontainers.image.description='Self Service Password is a simple PHP application that allows users to change their password on an LDAP directory' \
      org.opencontainers.image.url='https://ltb-project.org/documentation/self-service-password.html' \
      org.opencontainers.image.ref.name='self-service-password' \
      org.opencontainers.image.documentation='https://self-service-password.readthedocs.io/' \
      org.opencontainers.image.title='self-service-password docker image' \
      org.opencontainers.image.source='https://github.com/ltb-project/self-service-password/' \
      org.opencontainers.image.vendor='LTB-project.org' \
      org.opencontainers.image.version='1.6.0' \
      org.opencontainers.image.licenses='GPL-2+'

RUN apk add $BUILDDEP --no-cache \
    && docker-php-ext-install bcmath bz2 intl mbstring opcache curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install ldap gd \
    && docker-php-ext-enable ldap gd

RUN mkdir -p /usr/share/php/smarty4/ && \
    curl -Lqs https://github.com/smarty-php/smarty/archive/refs/tags/v4.4.1.tar.gz | \
    tar xzf - -C /usr/share/php/smarty4/ --strip-components=2
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY . /var/www
RUN rmdir /var/www/html && \
    mv /var/www/htdocs /var/www/html && \
    mkdir -p /var/www/templates_c && \
    chown -R apache: /var/www/templates_c && \
    sed -i 's/smarty3/smarty4/' /var/www/conf/config.inc.php && \
    cp -a /var/www/conf/config.inc.php /var/www/config.inc.php.orig
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN cd /var/www && /usr/bin/composer install
ENV LC_CTYPE=en_US.UTF-8
EXPOSE 80
RUN sed -i 's|/var/www/localhost/htdocs|/var/www/html|g' /etc/apache2/httpd.conf
ENTRYPOINT ["/var/www/entrypoint.sh"]
