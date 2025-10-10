<x-navfooter>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Pending Word Requests</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($pendingRequests->isEmpty())
            <p class="text-gray-600">No pending word requests at the moment.</p>
        @else
            <div class="space-y-4">
                @foreach ($pendingRequests as $word)
                    <div class="bg-white shadow-md rounded-lg p-4 border border-gray-200">
                        <h2 class="text-xl font-semibold text-indigo-700">{{ $word->name }}</h2>
                        <p class="text-gray-700 mt-2">
                            <span class="font-semibold">Definition:</span> {{ $word->definition }}
                        </p>

                        @if ($word->examples)
                            <p class="text-gray-700 mt-1">
                                <span class="font-semibold">Examples:</span> {{ $word->examples }}
                            </p>
                        @endif

                        @if ($word->idioms)
                            <p class="text-gray-700 mt-1">
                                <span class="font-semibold">Idioms:</span> {{ $word->idioms }}
                            </p>
                        @endif

                        @if ($word->image)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $word->image) }}" alt="Word Image"
                                    class="w-32 h-32 object-cover rounded-lg border">
                            </div>
                        @endif

                        <p class="text-sm text-gray-500 mt-2">
                            Submitted by:
                            <span class="font-medium">{{ $word->student->name ?? 'Unknown' }}</span>
                        </p>

                        <div class="mt-4 flex space-x-2">
                            <form action="{{ route('scholar.approve', $word->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                    Approve
                                </button>
                            </form>

                            <form action="{{ route('scholar.reject', $word->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
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
