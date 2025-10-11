<x-navfooter>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center sm:text-left">Reviewed Word Requests</h1>

        @if ($reviewedRequests->isEmpty())
            <p class="text-gray-600 text-center sm:text-left">No reviewed word requests yet.</p>
        @else
            <div class="space-y-6">
                @foreach ($reviewedRequests as $request)
                    <div class="bg-white shadow-md rounded-lg p-4 sm:p-6 border border-gray-200 hover:shadow-lg transition duration-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <h2 class="text-lg sm:text-xl font-semibold text-indigo-700 break-words">
                                {{ $request->definition }}
                            </h2>

                            <div class="mt-2 sm:mt-0">
                                @if ($request->status === 'approved_by_scholar')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded text-xs sm:text-sm font-semibold">
                                        Approved
                                    </span>
                                @elseif($request->status === 'rejected_by_scholar')
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded text-xs sm:text-sm font-semibold">
                                        Rejected
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-3 space-y-2 text-gray-700 text-sm sm:text-base">
                            <p><span class="font-semibold">Examples:</span> {{ $request->examples ?? '—' }}</p>
                            <p><span class="font-semibold">Idioms:</span> {{ $request->idioms ?? '—' }}</p>
                        </div>

                        @if ($request->image)
                            <div class="mt-4 flex justify-center sm:justify-start">
                                <img src="{{ asset('storage/' . $request->image) }}"
                                     alt="Word Image"
                                     class="w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-lg border border-gray-300 shadow-sm">
                            </div>
                        @endif

                        <p class="text-xs sm:text-sm text-gray-500 mt-3">
                            Submitted by: <span class="font-medium">{{ $request->student->name ?? 'Unknown' }}</span>
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-navfooter>
