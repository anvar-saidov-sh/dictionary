<x-navfooter>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl sm:text-4xl font-bold mb-6 text-indigo-700 text-center sm:text-left">
            Pending Words
        </h1>
        @if ($pendingWords->isEmpty())
            <p class="text-gray-600 text-center sm:text-left">No pending words at the moment.</p>
        @else
            <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($pendingWords as $word)
                    <div class="bg-white shadow-md rounded-xl p-5 border border-gray-200 hover:shadow-lg transition duration-200">

                        <h2 class="text-xl font-semibold text-indigo-700 truncate">{{ $word->word }}</h2>

                        <p class="text-gray-700 mt-2">
                            <span class="font-semibold">Definition:</span>
                            {{ $word->definition }}
                        </p>

                        <p class="text-sm text-gray-500 mt-2">
                            Submitted by:
                            <span class="font-medium text-gray-700">{{ $word->student->name ?? 'Anonymous' }}</span>
                        </p>

                        <div class="mt-4 flex flex-wrap gap-2 justify-center sm:justify-start">
                            <form action="{{ route('scholar.approves', $word->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full sm:w-auto bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                                    Approve
                                </button>
                            </form>

                            <form action="{{ route('scholar.rejects', $word->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full sm:w-auto bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Reject
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-navfooter>
