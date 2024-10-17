FROM php:8.2-fpm

# 設置目錄
WORKDIR /var/www

# 安裝依賴
RUN apt-get update && apt-get install -y \
    libaio1 \
    unzip \
    systemctl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 為了測試 mysql 裝的
RUN docker-php-ext-install pdo_mysql

# 安装系统依赖和 PostgreSQL 扩展
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pgsql \
    && docker-php-ext-install pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 創見 Oracle Instant Client 安裝目錄
RUN mkdir -p /opt/oracle

# 複製 Oracle Instant Client ZIP 文件
COPY instantclient-basic-linux.x64-19.24.0.0.0dbru.zip /opt/oracle/
COPY instantclient-sdk-linux.x64-19.24.0.0.0dbru.zip /opt/oracle/

# 解壓縮並移動
RUN cd /opt/oracle && \
    unzip instantclient-basic-linux.x64-19.24.0.0.0dbru.zip -d /opt/oracle && \
    unzip instantclient-sdk-linux.x64-19.24.0.0.0dbru.zip -d /opt/oracle && \
    rm instantclient-basic-linux.x64-19.24.0.0.0dbru.zip instantclient-sdk-linux.x64-19.24.0.0.0dbru.zip && \
    sh -c 'echo "/opt/oracle/instantclient_19_24" > /etc/ld.so.conf.d/oracle-instantclient' && \
    ldconfig

# 設置 LD_LIBRARY_PATH
ENV LD_LIBRARY_PATH=/opt/oracle/instantclient_19_24

# 安裝 PHP OCI8 extension
RUN echo "instantclient,/opt/oracle/instantclient_19_24" | pecl install oci8 && \
    sh -c 'echo "extension = oci8.so" >> /usr/local/etc/php/php.ini'

CMD ["php-fpm"]
