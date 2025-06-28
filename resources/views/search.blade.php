<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-white text-gray-900">

    <!-- Header -->
    <header class="flex flex-col md:flex-row items-center justify-between px-4 py-4 border-b gap-4 md:gap-0">
        <div class="flex items-center gap-3 w-full md:w-auto">
            <img src="" alt="Portfolio" class="h-8">
            <form action="{{ route('home') }}" method="GET" class="w-full md:w-auto">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search themes..."
                    class="border px-3 py-1 rounded-full w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </form>
        </div>
        <nav class="flex flex-wrap justify-center md:justify-end items-center gap-3 text-sm w-full md:w-auto">
            <a href="{{ route('search.page') }}" class="hover:underline">Browse Themes</a>
            <a href="#" class="hover:underline text-yellow-500 font-semibold">⚡ Premium</a>
            <a href="#" class="hover:underline">Freebies</a>
            @auth
            <span class="text-sm">Welcome, {{ Auth::user()->name }}!</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:underline text-red-500 ml-2">Logout</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="hover:underline">Sign in</a>
            <a href="{{ route('register') }}" class="hover:underline">Sign up</a>
            @endauth

            <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-4 py-2 rounded">Hire us</button>
        </nav>
        @if (session('success'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="fixed top-4 right-4 z-50 bg-green-100 text-green-800 px-4 py-2 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
        @endif


    </header>
 <main class="p-4 max-w-7xl mx-auto">
    <!-- Search Bar -->
    <div class="flex justify-center my-6">
        <form action="{{ route('search.page') }}" method="GET" class="w-full max-w-xl">
            <div class="relative">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search themes..."
                    class="w-full px-5 py-3 pr-12 rounded-full border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-600 hover:text-blue-800">
                    🔍
                </button>
            </div>
        </form>
    </div>

    <!-- Template List -->
    <div class="mt-8">
        @include('components/list_template')
    </div>
</main>
