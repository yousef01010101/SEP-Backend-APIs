# إعداد Gmail لإرسال البريد الإلكتروني

## ✅ الإعدادات المطلوبة في ملف `.env`

تأكد من أن ملف `.env` يحتوي على الإعدادات التالية **بدون مسافات إضافية**:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=yousuf_3738@gmail.com
MAIL_PASSWORD=wrnjqhiwiwmdnylv
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=yousuf_3738@gmail.com
MAIL_FROM_NAME=SEP
```

## ⚠️ ملاحظات مهمة:

1. **تأكد من عدم وجود مسافات قبل أو بعد علامة `=`**
   - ✅ صحيح: `MAIL_USERNAME=yousuf_3738@gmail.com`
   - ❌ خطأ: `MAIL_USERNAME = yousuf_3738@gmail.com`

2. **تأكد من عدم وجود علامات اقتباس حول القيم**
   - ✅ صحيح: `MAIL_FROM_NAME=SEP`
   - ❌ خطأ: `MAIL_FROM_NAME="SEP"`

3. **بعد تحديث ملف `.env`، قم بتشغيل:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

## 🔐 Gmail App Password

الكلمة التي استخدمتها (`wrnjqhiwiwmdnylv`) تبدو كـ App Password من Gmail، وهذا صحيح!

إذا لم تعمل، تأكد من:
- أنك قمت بإنشاء App Password من: https://myaccount.google.com/apppasswords
- أن "Less secure app access" مفعل (إذا كان متاحاً)
- أن "2-Step Verification" مفعل

## 🧪 اختبار الإعدادات

بعد تحديث `.env` ومسح الكاش، شغّل:
```bash
php test-mail-config.php
```

يجب أن ترى:
- MAIL_HOST: smtp.gmail.com ✅
- MAIL_USERNAME: ***configured*** ✅
- MAIL_PASSWORD: ***configured*** ✅

## 🚀 اختبار الإرسال

1. افتح المتصفح واذهب إلى: `http://localhost/SEP/forgot-password`
2. أدخل بريد إلكتروني مسجل في قاعدة البيانات
3. تحقق من صندوق الوارد في Gmail

## ❌ إذا استمرت المشكلة:

1. تأكد من أن ملف `.env` موجود في المجلد الرئيسي
2. تأكد من عدم وجود ملف `.env.example` فقط
3. أعد تشغيل الخادم إذا كنت تستخدم `php artisan serve`
4. تحقق من سجلات الأخطاء في `storage/logs/laravel.log`



