# استخدم صورة PHP 8.2 CLI كأساس
FROM php:8.2-cli

# تثبيت الأدوات والمكتبات المطلوبة
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev \
    libzip-dev libicu-dev \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl

# نسخ Composer من صورة رسمية
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تحديد مجلد العمل داخل الحاوية
WORKDIR /app

# نسخ جميع ملفات المشروع إلى داخل الحاوية
COPY . .

# تثبيت الحزم عبر Composer بدون بيئة التطوير
RUN composer install --no-dev --optimize-autoloader -vvv

# تنظيف الكاش لتفادي مشاكل الإعدادات أو الراوتات القديمة
RUN php artisan config:clear && \
    php artisan route:clear

# فتح البورت 10000 (اختياري للتوثيق)
EXPOSE 10000

# أمر التشغيل الأساسي: تشغيل Laravel server
CMD php artisan serve --host=0.0.0.0 --port=10000
