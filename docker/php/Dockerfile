FROM php:8.3-fpm

# Arguments defined in docker-compose.yml
ARG USER
ARG USER_ID
ARG GROUP_ID

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libgmp-dev \
    libsodium-dev \
    nodejs \
    npm \
    libpq-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd gmp zip

RUN pecl install xdebug &&docker-php-ext-enable xdebug pdo_mysql
RUN pecl install redis && docker-php-ext-enable redis

# Add some PHP parameters
ADD ./php.ini /usr/local/etc/php/php.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $USER_ID -d /home/${USER} ${USER}
RUN mkdir -p /home/${USER}/.composer && \
    chown -R ${USER}:${USER} /home/${USER}

# Set working directory
WORKDIR /app

USER "${USER_ID}:${GROUP_ID}"
