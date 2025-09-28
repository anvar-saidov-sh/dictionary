<x-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <form method="POST" action="{{ route('register') }}"
              class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8 space-y-6">
            @csrf
            <h2 class="text-2xl font-bold text-center text-gray-800">Create an Account</h2>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" placeholder="Your full name" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                              focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                              focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" placeholder="Choose a password" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                              focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                              focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 px-4 rounded-lg font-semibold shadow-md
                           hover:bg-green-700 hover:shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                Register
            </button>

            <p class="text-sm text-center text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-medium">
                    Login
                </a>
            </p>
        </form>
    </div>
</x-layout>
