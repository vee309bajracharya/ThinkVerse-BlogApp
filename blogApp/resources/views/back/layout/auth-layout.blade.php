<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('pageTitle')</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('backend/vendors/images/title-icon.svg') }}" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/styles/icon-font.min.css') }}" />


    @vite('resources/css/app.css')
    @stack('stylesheets')
</head>

<body class="min-h-screen bg-[var(--main-bg)] bg-cover bg-center flex items-center justify-center">
    <section class="w-full max-w-screen-xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div class="hidden lg:block">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('backend/vendors/images/mainLogo2.png') }}" alt="Logo" class="w-full mx-auto" />
                </a>
            </div>
            <div>
                @yield('content')
            </div>
        </div>
    </section>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    @stack('scripts')
</body>
</html>
