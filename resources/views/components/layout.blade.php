<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'App' }}</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

  @if (session('success'))
    <div id="flash" class="p-4 text-center bg-green-50 text-green-600 font-semibold">
      {{ session('success') }}
    </div>
  @endif

  <header class="bg-white shadow-md">
    <nav class="container mx-auto flex justify-between items-center px-6 py-3">
      <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600 hover:text-indigo-800">
        📖 My Dictionary
      </a>

      <div class="flex space-x-6 items-center">
        <a href="{{ route('index') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Words</a>
        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Dashboard</a>

        @auth
          <div class="relative group">
            <button class="text-gray-800 font-semibold flex items-center space-x-1">
              <span>{{ auth()->user()->name }}</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                   viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <div class="absolute hidden group-hover:block right-0 mt-2 bg-white border rounded-lg shadow-lg w-40">
              <a href="{{ url('/profile') }}"
                 class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>

              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                  Logout
                </button>
              </form>
            </div>
          </div>
        @else
          <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Login</a>
          <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Register</a>
        @endauth
      </div>
    </nav>
  </header>

  <main class="flex-1 container mx-auto px-6 py-6">
    {{ $slot }}
  </main>
</body>
</html>
