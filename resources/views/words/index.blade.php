<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <div class="flex flex-wrap w-[100%] gap-5 mt-4 items-center justify-center h-[90px]">
        @foreach (range('A', 'Z') as $alphabet)
            @if ($alphabet != 'C' && $alphabet != 'W')
                <h2 class="text-4xl hover:text-5xl hover:text-gray-500 text-gray-800 cursor-pointer ease-in-out transition duration-100">
                    {{ $alphabet }}
                </h2>
            @endif
        @endforeach
        <h2 class="text-4xl hover:text-5xl hover:text-gray-500 text-gray-800 cursor-pointer ease-in-out transition duration-100">
            Oʻ
        </h2>
        <h2 class="text-4xl hover:text-5xl hover:text-gray-500 text-gray-800 cursor-pointer ease-in-out transition duration-100">
            Gʻ
        </h2>
        <h2 class="text-4xl hover:text-5xl hover:text-gray-500 text-gray-800 cursor-pointer ease-in-out transition duration-100">
            Sh
        </h2>
        <h2 class="text-4xl hover:text-5xl hover:text-gray-500 text-gray-800 cursor-pointer ease-in-out transition duration-100">
            Ch
        </h2>
    </div>
</body>

</html>
