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
    @php
        $specials = [
            'Oʻ' => 'o-',
            'Gʻ' => 'g-',
            'Sh' => 'sh',
            'Ch' => 'ch',
        ];
    @endphp
    <div class="flex flex-wrap w-[100%] gap-5 mt-4 items-center justify-center h-[90px]">
        @foreach (range('A', 'Z') as $alphabet)
            @if ($alphabet != 'C' && $alphabet != 'W')
                <a href="{{ url('/words/' . strtolower($alphabet)) }}">
                    <h2
                        class="text-4xl hover:text-gray-500 text-gray-800 cursor-pointer ease-in-out transition duration-200 hover:animate-bounce">
                        {{ $alphabet }}
                    </h2>
                </a>
            @endif
        @endforeach
        @foreach ($specials as $letter => $slug)
            <a href="{{ url(`/words/` . $slug) }}">
                <h2
                    class="text-4xl hover:text-gray-500 text-gray-800 cursor-pointer ease-in-out transition duration-100 hover:animate-bounce">
                    {{ $letter }}
                </h2>
            </a>
        @endforeach
    </div>
    <form action="{{ route('words.create') }}" method="get">
        <button type="submit">Create</button>
    </form>
</body>

</html>
