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
    <h1>Add New Word</h1>

    @if ($errors->any())
        <div>
            <strong>Whoops!</strong> Something went wrong.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('words.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Word:</label>
        <input type="text" name="name" required><br>

        <label>Definition:</label>
        <textarea name="definition" required></textarea><br>

        <label>Examples:</label>
        <textarea name="examples"></textarea><br>

        <label>Idioms:</label>
        <textarea name="idioms"></textarea><br>

        <label>Image:</label>
        <input type="file" name="image"><br><br>

        <button type="submit">Save Word</button>
    </form>
</body>

</html>
