<x-layout>
    <section class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-sm">
            <h2 class="text-2xl font-bold mb-4 text-center text-indigo-600">Scholar Login</h2>
            <form action="{{ route('scholar.login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" required class="w-full p-2 border rounded-lg">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Password</label>
                    <input type="password" name="password" required class="w-full p-2 border rounded-lg">
                </div>
                <button type="submit"
                    class="w-full py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition">
                    Login
                </button>
            </form>
        </div>
    </section>
</x-layout>
