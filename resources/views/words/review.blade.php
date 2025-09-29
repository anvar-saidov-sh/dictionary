<x-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold text-indigo-700 mb-4">{{ $word->name }}</h1>

        <p class="text-gray-700 mb-6">
            <span class="font-semibold">Author:</span> {{ $word->user->name ?? 'Unknown' }}
        </p>

        <div class="flex gap-3">
            <a href=""
               class="px-4 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 transition">
                Edit
            </a>

            <form action="" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this word?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                    Delete
                </button>
            </form>

            <a href="{{ url()->previous() }}"
               class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition">
                Back
            </a>
        </div>
    </div>
</x-layout>
