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
    <div class="">
        <form action="{{ route('words.create') }}" method="post">
            @csrf
            <input type="text" placeholder="Enter the word" required>
            <input type="text" placeholder="Enter the definition" required>
            <input type="text" placeholder="Enter the examples">
            <input type="text" placeholder="Enter the idioms">
            <input type="file" placeholder="Enter the image">
        </form>
    </div>
</body>
</html>
