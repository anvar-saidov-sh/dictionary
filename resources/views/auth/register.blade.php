<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
    <section class="flex-col w-[500px] box-border bg-amber-50 h-[500px]  m-auto">
        <form action="/register" method="POST">
            @csrf
            <input name="name" placeholder="Name">
            <input name="email" type="email" placeholder="Email">
            <input name="password" type="password" placeholder="Password">
            <input name="password_confirmation" type="password" placeholder="Confirm">
            <button type="submit">Register</button>
        </form>
    </section>
</body>

</html>
