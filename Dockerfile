FROM php:apache

MAINTAINER Squad-network-dc

RUN set -x \
    && apt-get update \
    && apt-get install -y libldap2-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap \
    && apt-get purge -y --auto-remove libldap2-dev
RUN a2enmod rewrite

EXPOSE 80

WORKDIR /var/www/html

COPY ./ /var/www/html
