<x-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6 sm:p-8 md:p-10">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-indigo-700 mb-4 break-words text-center sm:text-left">
            {{ $word->name }}
        </h1>

        <div class="space-y-3 mb-6">
            <p class="text-lg sm:text-xl font-semibold text-gray-800 break-words">
                {{ $word->definition }}
            </p>
            <p class="text-lg sm:text-xl font-semibold text-gray-800 break-words">
                {{ $word->examples }}
            </p>
            <p class="text-lg sm:text-xl font-semibold text-gray-800 break-words">
                {{ $word->idioms }}
            </p>

            <p class="text-gray-700 mt-4">
                <span class="font-semibold">Author:</span> {{ $word->student->name ?? 'Unknown' }}
            </p>
        </div>

        <div class="flex flex-col sm:flex-row sm:flex-wrap gap-3 justify-center sm:justify-start">
            @if ($word->student_id === auth()->id())
                <a href="{{ route('words.edit', [$letter, $word->id]) }}"
                    class="w-full sm:w-auto px-4 py-2 bg-yellow-400 text-white text-center rounded-lg hover:bg-yellow-500 transition">
                    Edit
                </a>

                <form action="{{ route('words.destroy', [$letter, $word->id]) }}" method="POST"
                    class="w-full sm:w-auto inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full sm:w-auto px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition"
                        onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
            @else
                <form action="{{ route('words.requests.create', [$letter, $word->id]) }}" method="GET"
                    class="w-full sm:w-auto inline">
                    @csrf
                    <button type="submit"
                        class="w-full sm:w-auto px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition">
                        Request
                    </button>
                </form>
            @endif

            <a href="{{ url()->previous() }}"
                class="w-full sm:w-auto px-4 py-2 bg-gray-500 text-white text-center rounded-lg hover:bg-gray-600 transition">
                Back
            </a>
        </div>
    </div>
</x-layout>
