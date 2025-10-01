<x-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-extrabold text-indigo-700 mb-4">{{ $word->name }}</h1>
        <p class="text-xl font-semibold text-gray-800 mb-1.5">{{$word->definition}}</p>
        <p class="text-xl font-semibold text-gray-800 mb-1.5">{{$word->examples}}</p>
        <p class="text-xl font-semibold text-gray-800 mb-1.5">{{$word->idioms}}</p>
        <p class="text-gray-700 mb-6">
            <span class="font-semibold">Author:</span> {{ $word->student->name ?? 'Unknown' }}
        </p>

        <div class="flex gap-3">
            @if ($word->student_id === auth()->id())
                <a href="{{ route('words.edit', [$letter, $word->id]) }}"
                    class="px-3 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 transition">
                    Edit
                </a>

                <form action="{{ route('words.destroy', [$letter, $word->id]) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition"
                        onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
            @else
                <form action="{{ route('words.requests.create', [$letter, $word->id]) }}" method="GET" class="inline">
                    @csrf
                    <button type="submit"
                        class="px-3 py-2  bg-purple-400 text-white rounded-lg hover:bg-purple-500 transition">
                        Request
                    </button>
                </form>
            @endif


            <a href="{{ url()->previous() }}"
                class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition">
                Back
            </a>
        </div>
    </div>
</x-layout>
