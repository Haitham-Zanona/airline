# استخدم صورة PHP مع Composer مدمجة
FROM php:8.1-cli

# تثبيت الأدوات الأساسية
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تحديد مجلد العمل
WORKDIR /app

# نسخ الملفات
COPY . .

# تثبيت الحزم المطلوبة
RUN composer install --no-dev --optimize-autoloader

# توليد APP KEY عند بدء التشغيل
CMD php artisan config:clear && \
    php artisan route:clear && \
    php artisan key:generate && \
    php artisan serve --host=0.0.0.0 --port=10000
