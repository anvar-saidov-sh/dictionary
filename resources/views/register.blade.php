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
        <input type="text" name="" id="" placeholder="Enter your name" class="flex">
        <input type="email" name="" id="" placeholder="Enter your email">
        <input type="text" name="" id="" placeholder="Enter your username">
        <input type="password" name="" id="" placeholder="Enter your password">
        <input type="password" name="" id="" placeholder="Confirm your password">
    </section>
</body>
</html>
