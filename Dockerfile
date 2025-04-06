# استخدم صورة PHP مع Composer مدمجة
FROM php:8.1-cli

# تثبيت الأدوات الأساسية
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# نسخ composer من صورة Composer الرسمية
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تحديد مجلد العمل
WORKDIR /app

# نسخ الملفات إلى مجلد العمل
COPY . .

# التحقق من وجود ملف .env، وإذا لم يكن موجودًا ننسخ .env.example إلى .env
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# توليد APP KEY
RUN php artisan key:generate

# تثبيت الحزم المطلوبة باستخدام Composer
RUN composer install --no-dev --optimize-autoloader -vvv

# تنظيف الكاش للـ Laravel لتفادي مشاكل
RUN php artisan config:clear && \
    php artisan route:clear

# تشغيل السيرفر بعد بدء الحاوية
CMD php artisan serve --host=0.0.0.0 --port=10000
