<x-navfooter>
    <section class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="p-8">
            <h1 class="text-2xl font-bold mb-4">Welcome, {{ $scholar->name }}</h1>

            <h2 class="text-xl font-semibold mt-6 mb-2 flex gap-1"><x-heroicon-o-clock class="w-[24px] aspect-square" />Pending Word Approvals</h2>

            @if ($pendingWords->isEmpty())
                <p class="text-gray-600">No pending words to review.</p>
            @else
                <div class="space-y-4">
                    @foreach ($pendingWords as $word)
                        <div class="p-4 border rounded-lg bg-white shadow-sm">
                            <h3 class="text-lg font-semibold">{{ $word->name }}</h3>
                            <p class="text-gray-700">{{ $word->definition }}</p>
                            <p class="text-sm text-gray-500 mt-1">Created by: {{ $word->student->name }}</p>

                            <div class="flex gap-3 mt-3">
                                <form method="POST" action="{{ route('scholar.approve', $word->id) }}">
                                    @csrf
                                    <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                        Approve
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('scholar.reject', $word->id) }}">
                                    @csrf
                                    <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            @if ($pendingRequests->isEmpty())
                <p class="text-gray-600">No pending word requests to review.</p>
            @else
                <div class="space-y-4">
                    @foreach ($pendingRequests as $word)
                        <div class="p-4 border rounded-lg bg-white shadow-sm">
                            <h3 class="text-lg font-semibold">{{ $wordRequest->name }}</h3>
                            <p class="text-gray-700">{{ $wordRequest->definition }}</p>
                            <p class="text-sm text-gray-500 mt-1">Created by: {{ $word->student->name }}</p>

                            <div class="flex gap-3 mt-3">
                                <form method="POST" action="{{ route('scholar.approve', $wordRequest->id) }}">
                                    @csrf
                                    <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                        Approve
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('scholar.reject', $wordRequest->id) }}">
                                    @csrf
                                    <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-navfooter>
