<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>

  @vite('resources/css/app.css')
</head>
<body>
  @if (session('success'))
    <div id="flash" class="p-4 text-center bg-green-50 text-green-500 font-bold">
      {{ session('success') }}
    </div>
  @endif

  <header>
    
  </header>

  <main class="w-[100%]">
    {{ $slot }}
  </main>
</body>
</html>
