<x-layout>
    <form action="/register" method="POST">
        @csrf
        <h2>Register</h2>
        <input type="text" name="name" id="" placeholder="Enter your name">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit" class="btn mt-4">Register</button>
    </form>
</x-layout>
