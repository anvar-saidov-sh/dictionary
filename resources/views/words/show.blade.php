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
                    <div class="p-4 bg-white rounded-lg shadow hover:shadow-md transition">
                        <h2 class="text-xl font-semibold text-indigo-700">{{ $word->name }}</h2>
                        <p class="text-gray-600 mt-1">{{ $word->definition }}</p>

                        @if ($word->examples)
                            <p class="mt-2 text-sm text-gray-500"><strong>Example:</strong> {{ $word->examples }}</p>
                        @endif

                        @if ($word->idioms)
                            <p class="mt-2 text-sm text-gray-500"><strong>Idiom:</strong> {{ $word->idioms }}</p>
                        @endif

                        @if ($word->image)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $word->image) }}" alt="{{ $word->name }}" class="w-32 rounded">
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>

