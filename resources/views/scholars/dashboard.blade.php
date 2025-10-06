<x-navfooter>
    <section class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-2xl">
            <h1 class="text-2xl font-bold mb-4 text-indigo-600">
                Welcome, {{ $scholar->name }}
            </h1>
            <p class="text-gray-700 mb-6">You are logged in as a scholar.</p>

            <form action="{{ route('scholar.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                    Logout
                </button>
            </form>
        </div>
    </section>
</x-navfooter>
