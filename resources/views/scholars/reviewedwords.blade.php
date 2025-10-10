<x-navfooter>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Reviewed Words</h1>
        @if ($reviewedWords->isEmpty())
            <p class="text-gray-600">No reviewed words found.</p>
        @else
            <div class="space-y-4">
                @foreach ($reviewedWords as $word)
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
                            Submitted by: <span class="font-medium">{{ $word->student->name ?? 'Unknown' }}</span>
                        </p>

                        <div class="mt-4">
                            @if ($word->status === 'approved')
                                <span
                                    class="bg-green-100 text-green-700 px-3 py-1 rounded text-sm font-semibold">Approved</span>
                            @elseif($word->status === 'rejected')
                                <span
                                    class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm font-semibold">Rejected</span>
                            @else
                                <span
                                    class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-sm font-semibold">Pending
                                    Review</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-navfooter>
