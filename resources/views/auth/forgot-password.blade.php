<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نسيت كلمة المرور - SEP</title>
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
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-brand">SEP</h1>
            <h2 class="text-xl font-semibold mt-4 text-gray-800">استعادة كلمة المرور</h2>
            <p class="text-gray-600 mt-2 text-sm">أدخل بريدك الإلكتروني وسنرسل لك رابطاً لإعادة تعيين كلمة المرور.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-brand focus:border-brand block w-full p-2.5 outline-none transition-colors"
                    placeholder="name@example.com">
            </div>
            
            <button type="submit" 
                class="w-full text-white bg-brand hover:bg-brand-hover focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors">
                إرسال رابط استعادة كلمة المرور
            </button>
        </form>
    </div>
</body>
</html>
