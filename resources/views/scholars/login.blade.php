<x-layout>
    <section class="min-h-screen flex items-center justify-center bg-gray-100 px-4 sm:px-6 lg:px-8">
        <div class="bg-white w-full max-w-sm sm:max-w-md md:max-w-lg p-6 sm:p-8 rounded-2xl shadow-lg">

            <h2 class="text-2xl sm:text-3xl font-bold mb-6 text-center text-indigo-600">
                Scholar Login
            </h2>

            <form action="{{ route('scholar.login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-gray-700 font-medium mb-1" for="email">Email</label>
                    <input id="email" type="email" name="email" required
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1" for="password">Password</label>
                    <input id="password" type="password" name="password" required
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                </div>

                <button type="submit"
                        class="w-full py-3 bg-indigo-500 text-white rounded-lg font-semibold hover:bg-indigo-600 active:bg-indigo-700 transition-all duration-200">
                    Login
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Only authorized scholars can access this portal.
            </p>
        </div>
    </section>
</x-layout>
