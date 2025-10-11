<x-navfooter>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center sm:text-left">Reviewed Words</h1>

        @if ($reviewedWords->isEmpty())
            <p class="text-gray-600 text-center sm:text-left">No reviewed words found.</p>
        @else
            <div class="space-y-6">
                @foreach ($reviewedWords as $word)
                    <div class="bg-white shadow-md rounded-lg p-4 sm:p-6 border border-gray-200 hover:shadow-lg transition duration-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <h2 class="text-lg sm:text-xl font-semibold text-indigo-700 break-words">
                                {{ $word->name }}
                            </h2>

                            <div>
                                @if ($word->status === 'approved')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded text-xs sm:text-sm font-semibold">
                                        Approved
                                    </span>
                                @elseif($word->status === 'rejected')
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded text-xs sm:text-sm font-semibold">
                                        Rejected
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-xs sm:text-sm font-semibold">
                                        Pending Review
                                    </span>
                                @endif
                            </div>
                        </div>

                        <p class="text-gray-700 mt-3 text-sm sm:text-base">
                            <span class="font-semibold">Definition:</span> {{ $word->definition }}
                        </p>

                        @if ($word->examples)
                            <p class="text-gray-700 mt-2 text-sm sm:text-base">
                                <span class="font-semibold">Examples:</span> {{ $word->examples }}
                            </p>
                        @endif

                        @if ($word->idioms)
                            <p class="text-gray-700 mt-2 text-sm sm:text-base">
                                <span class="font-semibold">Idioms:</span> {{ $word->idioms }}
                            </p>
                        @endif

                        @if ($word->image)
                            <div class="mt-4 flex justify-center sm:justify-start">
                                <img src="{{ asset('storage/' . $word->image) }}"
                                     alt="Word Image"
                                     class="w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-lg border border-gray-300 shadow-sm">
                            </div>
                        @endif

                        <p class="text-xs sm:text-sm text-gray-500 mt-3">
                            Submitted by: <span class="font-medium">{{ $word->student->name ?? 'Unknown' }}</span>
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-navfooter>
