<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم تغيير كلمة المرور - SEP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');
        body { font-family: 'Cairo', sans-serif; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '#B35100',
                            hover: '#8a3e00',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md text-center">
        <div class="mb-6 flex justify-center">
            <div class="h-16 w-16 bg-green-100 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-brand mb-2">SEP</h1>
        <h2 class="text-xl font-semibold text-gray-800 mb-4">تم تغيير كلمة المرور بنجاح</h2>
        
        <p class="text-gray-600 mb-8">يمكنك الآن العودة إلى التطبيق وتسجيل الدخول باستخدام كلمة المرور الجديدة.</p>

        <div class="text-sm text-gray-500">
           يمكنك إغلاق هذه الصفحة الآن.
        </div>
    </div>
</body>
</html>
