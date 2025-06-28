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
  <!-- Secondary Navigation -->
  <div class="bg-gray-50 text-sm py-3 px-4 flex flex-wrap gap-3 justify-center md:justify-start border-b">
    <a href="#" class="hover:underline">Admin & Dashboard</a>
    <a href="#" class="hover:underline">Bootstrap 5</a>
    <a href="#" class="hover:underline">Material UI</a>
    <a href="#" class="hover:underline">Tailwind CSS</a>
    <a href="#" class="hover:underline">eCommerce</a>
    <a href="#" class="hover:underline">Landing Pages</a>
    <a href="#" class="hover:underline">Business & Corporate</a>
    <a href="#" class="hover:underline">Portfolio</a>
    <a href="#" class="hover:underline">Educational</a>
    <a href="#" class="bg-orange-100 text-orange-600 rounded-full px-2">Bundle — Save 80%</a>
  </div>

  <!-- Hero Section -->
  <section class="flex flex-col-reverse md:flex-row items-center justify-center gap-10 px-4 md:px-12 py-12">
    @include('components/list_template')

  </section>

</body>

</html>