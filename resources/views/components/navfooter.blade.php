<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">

  @if (session('success'))
    <div id="flash" class="p-4 text-center bg-green-50 text-green-600 font-semibold">
      {{ session('success') }}
    </div>
  @endif

  <header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">

      <a href="/" class="text-2xl font-bold text-indigo-600">MyDictionary</a>

      <button id="menu-toggle"
              class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400">
        <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <nav id="menu"
           class="hidden md:flex flex-col md:flex-row absolute md:static top-full left-0 w-full md:w-auto
                  bg-white md:bg-transparent border md:border-0 rounded-lg md:rounded-none shadow-md md:shadow-none
                  mt-2 md:mt-0 space-y-3 md:space-y-0 md:space-x-6 p-4 md:p-0">
        <a href="{{ route('index') }}" class="hover:text-indigo-600 transition">Words</a>
        <a href="{{ route('words.create') }}" class="hover:text-indigo-600 transition">Add Word</a>

        <div class="relative group">
          <button class="flex items-center space-x-2 focus:outline-none">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}"
                 alt="User Avatar"
                 class="w-9 h-9 rounded-full border border-gray-300">
            <span class="font-medium">{{ Auth::user()->name ?? 'User' }}</span>
            <svg class="w-4 h-4 text-gray-500 group-hover:rotate-180 transition-transform"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <div class="absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg opacity-0 invisible
                      group-hover:opacity-100 group-hover:visible transform scale-95 group-hover:scale-100
                      transition-all duration-200 ease-out">
            <a href="{{ route('scholar.dashboard') }}"
               class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-t-lg">
              Dashboard
            </a>
            <form action="{{ route('scholar.logout') }}" method="POST">
              @csrf
              <button type="submit"
                    class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-b-lg">
                Logout
              </button>
            </form>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-4 sm:px-6 py-6">
    {{ $slot }}
  </main>

  <script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
      const menu = document.getElementById('menu');
      menu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
