<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'MyDictionary' }}</title>
  @vite('resources/css/app.css')
  <script>
    function toggleMenu() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    }
  </script>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

  @if (session('success'))
    <div id="flash" class="p-4 text-center bg-green-50 text-green-600 font-semibold">
      {{ session('success') }}
    </div>
  @endif

  <header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
      <a href="/" class="text-2xl font-bold text-indigo-600">MyDictionary</a>

      <nav class="hidden md:flex items-center space-x-6">
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
            <a href="{{ route('students.index') }}"
               class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-t-lg">
              Profile
            </a>
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
              Dashboard
            </a>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit"
                      class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-b-lg">
                Logout
              </button>
            </form>
          </div>
        </div>
      </nav>


      <button onclick="toggleMenu()" class="md:hidden flex items-center text-gray-600 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>


    <nav id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100 shadow-sm">
      <div class="px-4 py-3 space-y-2">
        <a href="{{ route('index') }}" class="block text-gray-700 hover:text-indigo-600 transition">Words</a>
        <a href="{{ route('words.create') }}" class="block text-gray-700 hover:text-indigo-600 transition">Add Word</a>
        <a href="{{ route('students.index') }}" class="block text-gray-700 hover:text-indigo-600 transition">Profile</a>
        <a href="{{ route('dashboard') }}" class="block text-gray-700 hover:text-indigo-600 transition">Dashboard</a>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit"
                  class="w-full text-left block text-gray-700 hover:text-red-600 transition">
            Logout
          </button>
        </form>
      </div>
    </nav>
  </header>


  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex-grow">
    {{ $slot }}
  </main>
  <footer class="bg-gray-100 text-center py-4 text-sm text-gray-600">
    &copy; {{ date('Y') }} MyDictionary. All rights reserved.
  </footer>
</body>
</html>
