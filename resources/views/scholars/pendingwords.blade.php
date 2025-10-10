<x-navfooter>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Pending Words</h1>
        @if ($pendingWords->isEmpty())
            <p class="text-gray-600">No pending words at the moment.</p>
        @else
            <div class="space-y-4">
                @foreach ($pendingWords as $word)
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h2 class="text-xl font-semibold">{{ $word->word }}</h2>
                        <p class="text-gray-700 mt-2">{{ $word->definition }}</p>
                        <p class="text-sm text-gray-500 mt-1">Submitted by: {{ $word->student->name ?? 'Anonymous' }}</p>
                        <div class="mt-4 flex space-x-2">
                            <form action="{{ route('scholar.approve', $word->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Approve</button>
                            </form>
                            <form action="{{ route('scholar.reject', $word->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Reject</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-navfooter>
