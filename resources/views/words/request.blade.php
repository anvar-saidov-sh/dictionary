<x-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Request Changes for: {{ $word->word }}</h2>

        <form action="{{ route('words.requests.store', [$letter, $word->id]) }}" method="POST">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium mb-2">Definition</label>
                <textarea name="definition" class="w-full border rounded p-2" rows="3" required>{{ old('definition') }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Examples</label>
                <textarea name="examples" class="w-full border rounded p-2" rows="3">{{ old('examples') }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Idioms</label>
                <textarea name="idioms" class="w-full border rounded p-2" rows="3">{{ old('idioms') }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Message (to the owner)</label>
                <textarea name="message" class="w-full border rounded p-2" rows="3">{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">
                Send Request
            </button>
        </form>
    </div>
</x-layout>
