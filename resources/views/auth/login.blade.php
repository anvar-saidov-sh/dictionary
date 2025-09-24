<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="/login" method="POST">
        @csrf
        <input name="email" type="email" placeholder="Email">
        <input name="password" type="password" placeholder="Password">
        <label>
            <input type="checkbox" name="remember"> Remember me
        </label>
        <button type="submit">Login</button>
    </form>

</body>

</html>
