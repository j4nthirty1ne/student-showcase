<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Student Project Showcase')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex flex-col min-h-screen">
        @include('components.navbar')
        
        <main class="flex-grow">
            @yield('content')
        </main>
        
        @include('components.footer')
    </div>
</body>
</html>
