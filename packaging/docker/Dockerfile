ARG VERSION=latest

ARG SMARTY_VERSION=4.4.1
ARG SMARTY_DIR=/usr/share/php/smarty${SMARTY_VERSION%%.*}
ARG SMARTY_URL=https://github.com/smarty-php/smarty/archive/refs/tags/v${SMARTY_VERSION}.tar.gz

ARG COMPOSER_VERSION=lts
ARG COMPOSER_IMAGE=composer/composer:${COMPOSER_VERSION}-bin

ARG BASE_IMAGE=php:8.2-apache

FROM ${COMPOSER_IMAGE} AS composer
FROM ${BASE_IMAGE} AS base

ARG MIRROR=
ARG DEBIAN_MIRROR=${MIRROR:+${MIRROR}/debian}

RUN [ -z "${DEBIAN_MIRROR}" ] || \
    sed -e "s#https\?://\(:\?\(:\?deb\)\|\(:\?security\)\)\.debian\.org/debian#${DEBIAN_MIRROR}#g" \
        -i \
        $([ -e "/etc/apt/sources.list.d/debian.sources" ] && \
            echo -n /etc/apt/sources.list.d/debian.sources || \
            echo -n /etc/apt/sources.list)

ARG RUNTIME_DEPS=" \
        locales \
        locales-all \
    "
RUN --mount=type=cache,target=/var/lib/apt/lists \
    set -ex; \
    \
    apt-get update; \
    apt-get install -y --no-install-recommends ${RUNTIME_DEPS}; \
    :;

ARG LC_CTYPE=en_US.UTF-8
ENV LC_CTYPE=${LC_CTYPE}

ARG ADD_LOCALE_GEN="en_US.UTF-8 UTF-8"
RUN [ -z "$ADD_LOCALE_GEN" ] || \
    grep -x "$ADD_LOCALE_GEN" /etc/locale.gen || \
        { echo "$ADD_LOCALE_GEN" >> /etc/locale.gen && /usr/sbin/locale-gen; }

ARG BUILD_DEPS=" \
        libbz2-dev \
        libicu-dev \
        libfreetype6-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libwebp-dev \
        libldap2-dev \
    "
RUN --mount=type=cache,target=/var/lib/apt/lists \
    set -ex; \
    \
    savedAptMark="$(apt-mark showmanual)"; \
    \
    apt-get update; \
    apt-get install -y --no-install-recommends ${BUILD_DEPS}; \
    \
    docker-php-source extract; \
    docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp; \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/; \
    docker-php-ext-install -j "$(nproc)" \
        bcmath \
        bz2 \
        intl \
        opcache \
        ldap \
        gd \
        ; \
    docker-php-source delete; \
    a2enmod rewrite; \
    \
# reset apt-mark's "manual" list so that "purge --auto-remove" will remove all build dependencies
    apt-mark auto '.*' > /dev/null; \
    apt-mark manual $savedAptMark; \
    ldd "$(php -r 'echo ini_get("extension_dir");')"/*.so \
        | awk '/=>/ { so = $(NF-1); if (index(so, "/usr/local/") == 1) { next }; gsub("^/(usr/)?", "", so); print so }' \
        | sort -u \
        | xargs -r dpkg-query --search \
        | cut -d: -f1 \
        | sort -u \
        | xargs -rt apt-mark manual; \
    \
    apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false; \
    ln -s "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"; \
    :;

FROM base AS build

WORKDIR /build

ARG SMARTY_VERSION
ARG SMARTY_URL
ARG SMARTY_DIR
ARG COMPOSER_IMAGE

COPY --from=composer /composer /usr/bin/composer

RUN install --owner www-data --group www-data --directory -D "/rootfs${SMARTY_DIR}"
ADD $SMARTY_URL ./
RUN tar xzf *.tar.gz -C "/rootfs${SMARTY_DIR}" --strip-components=2 --verbose --owner www-data --group www-data

RUN set -ex; \
    \
    apt-get update; \
    apt-get install -y --no-install-recommends git unzip;

ARG INSTALL_PATHS=" \
    htdocs/ \
    lang/ \
    lib/ \
    scripts/ \
    templates/ \
    vendor/ \
    entrypoint.sh \
    LICENCE \
"

ARG EXCLUDE_PATHS=" \
    htdocs/vendor/.gitignore \
"

RUN --mount=type=cache,target=/root/.composer \
    --mount=type=bind,target=/build/ssp,rw \
    cd ssp && \
    set -ex; \
    composer update --no-dev; \
    \
    INSTALL_EXPR=; \
    for p in ${INSTALL_PATHS}; do \
        [ -z "${p##*/}" ] && p="\"./${p}*\"" || p="\"./$p\""; \
        INSTALL_EXPR="${INSTALL_EXPR:+${INSTALL_EXPR} -or }-path $p"; \
    done; \
    \
    EXCLUDE_EXPR=; \
    for p in ${EXCLUDE_PATHS}; do \
        [ -z "${p##*/}" ] && p="\"./${p}*\"" || p="\"./$p\""; \
        EXCLUDE_EXPR="${EXCLUDE_EXPR:+${EXCLUDE_EXPR} -or }-path $p"; \
    done; \
    \
    BIN_PATHS=$(eval "find -type d -name bin \( $INSTALL_EXPR \) -not \( $EXCLUDE_EXPR \)"); \
    BIN_EXPR=; \
    for p in ${BIN_PATHS}; do \
        BIN_EXPR="${BIN_EXPR:+${BIN_EXPR} -or }-path \"$p/*\""; \
    done; \
    \
    eval "find -type f \( $BIN_EXPR \) -exec install -p -m 755 --owner www-data --group www-data -D {} /rootfs/var/www/{} \;"; \
    eval "find -type f \( $INSTALL_EXPR \) \
        -not \( $EXCLUDE_EXPR \) \
        -not \( $BIN_EXPR \) \
        -exec install -p -m 644 --owner www-data --group www-data -D {} /rootfs/var/www/{} \;"; \
    \
    chmod a+x /rootfs/var/www/entrypoint.sh /rootfs/var/www/scripts/*; \
    \
    install --owner www-data --group www-data --directory -D \
        "/rootfs/var/www/htdocs/vendor" "/rootfs/var/www/conf" "/rootfs/var/www/templates_c" \
        ; \
    sed \
        -e "s#/usr/share/php/smarty3#${SMARTY_DIR}#g" \
        -e "s#config\.inc\.local\.php#conf/\0#g" \
        conf/config.inc.php > /rootfs/var/www/config.inc.php.orig; \
    chown www-data:www-data /rootfs/var/www/config.inc.php.orig; \
    \
    find /etc/apache2/sites-available/ -type f -name \*.conf -exec install -p -m 644 -D {} /rootfs{} \; ; \
    sed -e "s#/var/www/html#/var/www/htdocs#g" -i /rootfs/etc/apache2/sites-available/*; \
    :;

FROM base

ARG VERSION
ARG BASE_IMAGE

LABEL org.opencontainers.image.authors='LTB-project.org, ltb-dev@ow2.org' \
      org.opencontainers.image.base.name="${BASE_IMAGE}" \
      org.opencontainers.image.description='Self Service Password is a simple PHP application that allows users to change their password on an LDAP directory' \
      org.opencontainers.image.url='https://ltb-project.org/documentation/self-service-password.html' \
      org.opencontainers.image.ref.name='self-service-password' \
      org.opencontainers.image.documentation='https://self-service-password.readthedocs.io/' \
      org.opencontainers.image.title='self-service-password docker image' \
      org.opencontainers.image.source='https://github.com/ltb-project/self-service-password/' \
      org.opencontainers.image.vendor='LTB-project.org' \
      org.opencontainers.image.version="${VERSION}" \
      org.opencontainers.image.licenses='GPL-2+'

COPY --from=build /rootfs /

WORKDIR /var/www/htdocs

VOLUME [ "/var/www/templates_c" , "/var/www/conf" ]
EXPOSE 80

ENTRYPOINT [ "/var/www/entrypoint.sh" ]
CMD [ "apache2-foreground" ]
