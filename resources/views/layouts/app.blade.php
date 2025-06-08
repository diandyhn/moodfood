<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MoodFood') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-2xl font-bold text-indigo-600">MoodFood</h1>
                <div class="space-x-4">
                    <a href="{{ route('mood.index') }}" class="text-gray-700 hover:text-indigo-600">Mood Detection</a>
                    <a href="{{ route('makanan.index') }}" class="text-gray-700 hover:text-indigo-600">Makanan</a>
                    <a href="{{ route('rekomendasi.index') }}" class="text-gray-700 hover:text-indigo-600">Rekomendasi</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        @yield('content')
    </main>
</body>
</html>
