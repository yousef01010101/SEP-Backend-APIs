# حل مشكلة مصادقة Gmail

## المشكلة الحالية:
Gmail يرفض المصادقة مع رسالة: "Username and Password not accepted"

## الحل: إنشاء App Password جديد

### الخطوة 1: تفعيل التحقق بخطوتين (2-Step Verification)
1. اذهب إلى: https://myaccount.google.com/security
2. ابحث عن "2-Step Verification"
3. فعّله إذا لم يكن مفعلاً

### الخطوة 2: إنشاء App Password
1. اذهب إلى: https://myaccount.google.com/apppasswords
   - أو من: https://myaccount.google.com/security → "App passwords"
2. اختر "Select app" → اختر "Mail"
3. اختر "Select device" → اختر "Other (Custom name)"
4. اكتب اسم مثل: "SEP Application"
5. اضغط "Generate"
6. **انسخ كلمة المرور التي تظهر (16 حرف بدون مسافات)**

### الخطوة 3: تحديث ملف `.env`
افتح ملف `.env` واستبدل `MAIL_PASSWORD` بالـ App Password الجديد:

```env
MAIL_PASSWORD=your-new-16-character-app-password
```

### الخطوة 4: مسح الكاش
```bash
php artisan config:clear
php artisan cache:clear
```

### الخطوة 5: الاختبار
```bash
php test-mail-simple.php
```

## ملاحظات مهمة:
- ⚠️ **لا تستخدم كلمة المرور العادية** - يجب استخدام App Password فقط
- ⚠️ **App Password مكون من 16 حرف بدون مسافات
- ⚠️ **إذا لم تظهر صفحة App Passwords**، تأكد من تفعيل 2-Step Verification أولاً

## بديل: استخدام OAuth2
إذا استمرت المشكلة، يمكن استخدام OAuth2 بدلاً من App Password (أكثر تعقيداً لكنه يتطلب إعداد إضافي.



