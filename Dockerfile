ARG OPENSWOOLE_VERSION
ARG PHP_VERSION
ARG COMPOSER_VERSION

FROM openswoole/swoole:${OPENSWOOLE_VERSION}-php${PHP_VERSION}

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir /usr/bin --filename composer && \
    chmod 755 /usr/bin/composer && \
    composer self-update --version ${COMPOSER_VERSION}

# Setup lib directory
RUN mkdir /usr/src/openswoole-bundle
WORKDIR /usr/src/openswoole-bundle

ENTRYPOINT sleep infinity
