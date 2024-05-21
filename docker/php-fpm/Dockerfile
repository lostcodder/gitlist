FROM php:8.2-fpm-alpine

ENV PHP_EXT_DEPS \
    gettext=gettext-dev \
    icu=icu-dev \
    libgcrypt=libgcrypt-dev \
    libxml2=libxml2-dev \
    libxslt=libxslt-dev \
    libzip=libzip-dev

RUN set -x; \
    apk add --no-cache --virtual .php-extensions-build-dependencies \
        $PHPIZE_DEPS \
        linux-headers \
        $(echo ${PHP_EXT_DEPS} | tr ' ' '\n' | cut -d = -f 2) \
    && apk add --no-cache \
        $(echo ${PHP_EXT_DEPS} | tr ' ' '\n' | cut -d = -f 1) \
    && docker-php-ext-install \
        exif \
        gettext \
        intl \
        opcache \
        sockets \
        xsl \
        zip \
    && printf "\n" | pecl install apcu xdebug \
    && docker-php-ext-enable apcu \
    && apk del .php-extensions-build-dependencies

RUN apk add --no-cache \
    bash \
    coreutils \
    git \
    grep \
    mercurial \
    make \
    wget \
    shadow

RUN groupmod -g 1000 www-data && usermod -u 1000 -g 1000 www-data

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --2

ENV PATH="/application/bin:/application/vendor/bin:${PATH}"

WORKDIR "/application"

COPY php.ini /usr/local/etc/php/conf.d/99-overrides.ini
COPY php-fpm.d/* /usr/local/etc/php-fpm.d/
