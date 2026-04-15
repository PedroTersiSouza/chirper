<!DOCTYPE html>
<html lang="en" data-theme="laravelChirper">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - Chirper' : 'Chirper' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <meta property="og:image" content="{{ asset('images/og.jpeg') }}" />
    <meta property="og:title" content="Chirper" />
    <meta property="og:description"
        content="A demo social media platform highlighting the power and simplicity of Laravel." />
    <meta property="og:url" content="https://chirper.laravel.cloud" />

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-96x96.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans text-base-content">

    <nav class="flex items-center justify-between bg-white shadow-sm px-6 py-3 mb-6">
    {{-- Lado Esquerdo: Logo --}}
    <div class="flex-shrink-0">
        <a href="/">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 312 69" class="h-7 w-auto">
                <path fill="url(#a)" d="M40.97.446c22.091 0 40 17.909 40 40a39.805 39.805 0 0 1-6.56 21.95c-.61.928-1.87 1.105-2.825.541a18.92 18.92 0 0 0-9.651-2.63c-.787 0-1.563.048-2.325.141a19.108 19.108 0 0 0-7.03-9.607 18.57 18.57 0 0 0 5.996-11.778l8.493-7.543a.931.931 0 0 0-.43-1.607l-10.423-2.138c-3.207-5.575-9.218-9.329-16.103-9.329-10.256 0-18.57 8.33-18.571 18.605 0 1.274.128 2.519.372 3.721-6.58.032-12.37 3.407-15.764 8.517-1.07 1.61-3.854 1.582-4.265-.306a40.101 40.101 0 0 1-.914-8.537c0-22.091 17.908-40 40-40Z" />
                <defs>
                    <linearGradient id="a" x1=".97" x2="72.586" y1=".446" y2="80.006" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#45B8FF" />
                        <stop offset="1" stop-color="#4B2A99" />
                    </linearGradient>
                </defs>
            </svg>
        </a>
    </div>

    {{-- Centro: Busca (FORÇADA) --}}
    <div class="flex-1 max-w-md mx-4">
        @auth
        <form action="{{ route('search') }}" method="GET" class="relative">
            <input 
                type="text" 
                name="query" 
                placeholder="Search chirps or users..." 
                class="w-full h-10 px-4 rounded-lg border border-gray-300 bg-gray-50 text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ request('query') }}"
            >
            <button type="submit" class="absolute right-3 top-2.5 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </form>
        @endauth
    </div>

    {{-- Lado Direito: User e Logout --}}
    <div class="flex items-center gap-4">
        @auth
            <div class="text-right hidden sm:block">
                <p class="text-xs text-gray-500 font-semibold">Logged as</p>
                <p class="text-sm font-bold text-gray-800">{{ auth()->user()->name }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-sm font-semibold">Sign In</a>
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-bold">Sign Up</a>
        @endauth
    </div>
</nav>

    @if (session('success'))
        <div class="toast toast-top toast-center z-50">
            <div class="alert alert-success shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <main class="flex-1 container mx-auto px-4 py-8 max-w-4xl">
        {{ $slot }}
    </main>

    <footer class="w-full mt-auto py-12 bg-base-100 border-t border-base-300">
        <div class="mx-auto w-full max-w-4xl px-4 text-center">
            <div class="opacity-20 grayscale mb-4">
               {{-- Ícone do Laravel --}}
               <svg class="mx-auto h-6 w-auto" viewBox="0 0 1280 308" fill="currentColor">
                   <path d="M50.2753 0H0V308.689H144.713V263.27H50.2753V0Z" />
                   {{-- (Cortei o resto do SVG gigante por brevidade, mas você pode manter o seu original aqui) --}}
               </svg>
            </div>
            <p class="text-xs text-base-content/50 uppercase tracking-widest font-bold">
                &copy; {{ date('Y') }} Chirper Project • Built with Laravel
            </p>
        </div>
    </footer>

</body>
</html>