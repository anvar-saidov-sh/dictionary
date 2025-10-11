<x-layout>
    <section class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
        <div class="w-full max-w-3xl bg-white shadow-lg rounded-2xl p-6 sm:p-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-indigo-700 mb-6 text-center break-words">
                {{ $word->name }}
            </h1>

            <div class="space-y-4 text-gray-800">
                <p class="text-lg sm:text-xl font-semibold leading-relaxed">
                    {{ $word->definition }}
                </p>

                @if ($word->examples)
                    <p class="text-lg sm:text-xl font-medium text-gray-700">
                        <span class="font-semibold text-indigo-600">Example:</span> {{ $word->examples }}
                    </p>
                @endif

                @if ($word->idioms)
                    <p class="text-lg sm:text-xl font-medium text-gray-700">
                        <span class="font-semibold text-indigo-600">Idiom:</span> {{ $word->idioms }}
                    </p>
                @endif

                <p class="text-gray-600 text-sm sm:text-base">
                    <span class="font-semibold">Author:</span> {{ $word->student->name ?? 'Unknown' }}
                </p>
            </div>

            <div class="flex flex-col sm:flex-row sm:justify-center sm:items-center gap-3 mt-8">
                @if ($word->student_id === auth()->id())
                    <a href="{{ route('words.edit', [$letter, $word->id]) }}"
                        class="w-full sm:w-auto text-center px-5 py-2.5 bg-yellow-400 text-white font-semibold rounded-lg shadow-md
                               hover:bg-yellow-500 hover:shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                        Edit
                    </a>

                    <form action="{{ route('words.destroy', [$letter, $word->id]) }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Are you sure?')"
                            class="w-full sm:w-auto text-center px-5 py-2.5 bg-red-500 text-white font-semibold rounded-lg shadow-md
                                   hover:bg-red-600 hover:shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                            Delete
                        </button>
                    </form>
                @else
                    <form action="{{ route('words.requests.create', [$letter, $word->id]) }}" method="GET" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit"
                            class="w-full sm:w-auto text-center px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-lg shadow-md
                                   hover:bg-purple-600 hover:shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                            Request
                        </button>
                    </form>
                @endif

                <a href="{{ url()->previous() }}"
                    class="w-full sm:w-auto text-center px-5 py-2.5 bg-gray-400 text-white font-semibold rounded-lg shadow-md
                           hover:bg-gray-500 hover:shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                    Back
                </a>
            </div>
        </div>
    </section>
</x-layout>
