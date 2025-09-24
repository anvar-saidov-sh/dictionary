<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="">
        <form action="/register" method="GET">
            @csrf
            <input type="text" placeholder="Enter name">
            <input type="email" placeholder="Enter email">
            <input type="password" name="password" id="password" placeholder="Enter password">
            <input type="password" name="password_confirmed" id="" placeholder="Confirm password">
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
