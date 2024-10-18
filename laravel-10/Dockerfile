FROM php:8.2-fpm

# 設置目錄
WORKDIR /var/www

# 安裝依賴
RUN apt-get update && apt-get install -y \
    # ----------- apt-get install 相關 -----------
    # basic
    libaio1 \
    unzip \
    systemctl \
    # tms
    gnupg \
    wget \
    # apt-utils避免報錯
    --assume-yes apt-utils \
    # 字形
    fonts-wqy-microhei \
    ttf-wqy-microhei \
    fonts-wqy-zenhei \
    ttf-wqy-zenhei \
    # Zip
    libzip-dev \
    zip \
    # Git
    git \
    # Curl
    libcurl3-dev \
    curl \
    # GD
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libjpeg-dev \
    libc-client-dev \
    libkrb5-dev \
    libxrender1 \
    # Mbstring
    libonig-dev \
    # ImageMagick
    imagemagick \
    --no-install-recommends libmagickwand-dev \
    # Human Language and Character Encoding Support
    zlib1g-dev \
    libicu-dev \
    g++ \
    # postgres
    libpq-dev \
    # ----------- 其它設定 -----------
    # 字形    
    && fc-cache -f -v \
    # Zip
    && docker-php-ext-configure zip \ 
    && docker-php-ext-install zip \
    # Curl
    && docker-php-ext-install curl \
    # GD
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    # Mbstring
    && docker-php-ext-configure mbstring \
    # ImageMagick
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    # postgres
    && docker-php-ext-install pgsql \
    && docker-php-ext-install pdo_pgsql \
    # mysql
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql \
    # BC Math
    && docker-php-ext-install bcmath \
    # Human Language and Character Encoding Support
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    # PHP Redis extension
    && pecl install redis \
    && docker-php-ext-enable redis \
    # Install Xdebug
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    # ----------- clean -----------
    && apt-get clean \
    && apt-get -y autoremove \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# 創見 Oracle Instant Client 安裝目錄
RUN mkdir -p /opt/oracle

# 複製 Oracle Instant Client ZIP 文件
COPY instantclient-basic-linux.x64-19.24.0.0.0dbru.zip /opt/oracle/
COPY instantclient-sdk-linux.x64-19.24.0.0.0dbru.zip /opt/oracle/

# 解壓縮並移動
RUN cd /opt/oracle && \
    unzip -q instantclient-basic-linux.x64-19.24.0.0.0dbru.zip -d /opt/oracle && \
    unzip -q instantclient-sdk-linux.x64-19.24.0.0.0dbru.zip -d /opt/oracle && \
    rm instantclient-basic-linux.x64-19.24.0.0.0dbru.zip instantclient-sdk-linux.x64-19.24.0.0.0dbru.zip && \
    sh -c 'echo "/opt/oracle/instantclient_19_24" > /etc/ld.so.conf.d/oracle-instantclient' && \
    ldconfig

# 設置 LD_LIBRARY_PATH
ENV LD_LIBRARY_PATH=/opt/oracle/instantclient_19_24

# 安裝 PHP OCI8 extension
RUN echo "instantclient,/opt/oracle/instantclient_19_24" | pecl install oci8 && \
    sh -c 'echo "extension = oci8.so" >> /usr/local/etc/php/php.ini' \
    sh -c 'echo "memory_limit = -1" >> /usr/local/etc/php/php.ini' \
    sh -c 'echo "zend_extension = opcache.so" >> /usr/local/etc/php/php.ini' \
    sh -c 'echo "opcache.enable = 1" >> /usr/local/etc/php/php.ini' \
    sh -c 'echo "opcache.jit_buffer_size = 100M" >> /usr/local/etc/php/php.ini' \
    sh -c 'echo "opcache.jit = 1255" >> /usr/local/etc/php/php.ini'

# 安裝 Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && chmod 0755 /usr/bin/composer

CMD ["php-fpm"]
