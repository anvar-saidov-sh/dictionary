<x-layout>
    <div class="max-w-4xl mx-auto mt-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Words starting with: <span class="text-indigo-600">{{ strtoupper($letter) }}</span>
        </h1>
        @if ($words->isEmpty())
            <p class="text-gray-500">No words found for this letter.</p>
        @else
            <div class="space-y-4">
                @foreach ($words as $word)
                    <div class="p-4 bg-white rounded-lg shadow hover:shadow-md transition flex justify-between">
                        <h2 class="text-xl font-semibold text-indigo-700">{{ $word->name }}</h2>
                        <a href="{{ route('words.review', [$letter, $word->id]) }}"
                            class="px-3 py-1 bg-blue-400 text-white rounded-lg hover:bg-blue-600 transition cursor-pointer">
                            Show
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
