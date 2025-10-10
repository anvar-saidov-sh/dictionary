<x-navfooter>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Reviewed Word Requests</h1>

        @if ($reviewedRequests->isEmpty())
            <p class="text-gray-600">No reviewed word requests yet.</p>
        @else
            <div class="space-y-4">
                @foreach ($reviewedRequests as $request)
                    <div class="bg-white shadow-md rounded-lg p-4 border border-gray-200">
                        <h2 class="text-xl font-semibold text-indigo-700">{{ $request->definition }}</h2>

                        <p class="text-gray-700 mt-2">
                            <span class="font-semibold">Examples:</span> {{ $request->examples ?? '—' }}
                        </p>
                        <p class="text-gray-700 mt-1">
                            <span class="font-semibold">Idioms:</span> {{ $request->idioms ?? '—' }}
                        </p>

                        @if ($request->image)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $request->image) }}" alt="Word Image"
                                    class="w-32 h-32 object-cover rounded-lg border">
                            </div>
                        @endif

                        <p class="text-sm text-gray-500 mt-2">
                            Submitted by: <span class="font-medium">{{ $request->student->name ?? 'Unknown' }}</span>
                        </p>

                        <div class="mt-4">
                            @if ($request->status === 'approved_by_scholar')
                                <span
                                    class="bg-green-100 text-green-700 px-3 py-1 rounded text-sm font-semibold">Approved</span>
                            @elseif($request->status === 'rejected_by_scholar')
                                <span
                                    class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm font-semibold">Rejected</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-navfooter>
