# إعداد البريد الإلكتروني لإعادة تعيين كلمة المرور

## المشكلة الحالية
Laravel يحاول الاتصال بـ Mailtrap على `127.0.0.1:2525` وهذا غير متاح.

## الحل: إعداد SMTP الحقيقي

### 1. افتح ملف `.env` في المجلد الرئيسي للمشروع

### 2. قم بتحديث إعدادات البريد الإلكتروني التالية:

#### للبريد الإلكتروني Outlook/Hotmail:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp-mail.outlook.com
MAIL_PORT=587
MAIL_USERNAME=your-email@outlook.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@outlook.com
MAIL_FROM_NAME="SEP"
```

#### للبريد الإلكتروني Gmail:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="SEP"
```

**ملاحظة مهمة لـ Gmail:**
- يجب استخدام "App Password" وليس كلمة المرور العادية
- قم بإنشاء App Password من: https://myaccount.google.com/apppasswords

#### للبريد الإلكتروني Yahoo:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mail.yahoo.com
MAIL_PORT=587
MAIL_USERNAME=your-email@yahoo.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@yahoo.com
MAIL_FROM_NAME="SEP"
```

### 3. بعد تحديث ملف `.env`، قم بتشغيل:
```bash
php artisan config:clear
php artisan cache:clear
```

### 4. اختبر الإرسال:
قم بزيارة `/forgot-password` وأدخل بريد إلكتروني مسجل في قاعدة البيانات.

## إعدادات إضافية

إذا كنت تستخدم XAMPP محلياً وترغب في استخدام SMTP محلي:

### استخدام MailHog (للتطوير المحلي):
```env
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="SEP"
```

### استخدام Mailtrap (للتطوير):
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="SEP"
```

## التحقق من الإعدادات

بعد تحديث `.env`، تأكد من أن الإعدادات صحيحة:
```bash
php artisan tinker
>>> config('mail.mailers.smtp')
```

يجب أن ترى الإعدادات المحدثة.



