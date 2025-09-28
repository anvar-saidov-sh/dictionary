<x-layout>
    <section class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-3xl bg-white shadow-lg rounded-xl p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                Welcome, <span class="text-indigo-600">{{ auth()->user()->name }}</span>
            </h1>

            <div class="flex gap-4 mb-6">
                <a href="{{ route('words.create') }}"
                    class="px-4 py-2 bg-indigo-500 text-white rounded-lg shadow hover:bg-indigo-600 transition">
                    Create Word
                </a>

                <a href="{{ route('index') }}"
                    class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">
                    Words List
                </a>
            </div>

            <form action="{{ route('logout') }}" method="post" class="mt-4">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition">
                     Logout
                </button>
            </form>
        </div>
    </section>
</x-layout>
