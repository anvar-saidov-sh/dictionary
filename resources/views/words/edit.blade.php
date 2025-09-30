<x-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-indigo-700 mb-6">Edit Word Details</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('words.update', [$letter, $word->id]) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-medium">Word:</label>
                <p class="w-full border border-gray-100 bg-gray-100 rounded-lg p-2 font-bold capitalize" >{{ $word->name }}</p>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Definition:</label>
                <textarea name="definition" rows="3" required
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-indigo-200">{{ old('definition', $word->definition) }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Examples:</label>
                <textarea name="examples" rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-indigo-200">{{ old('examples', $word->examples) }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Idioms:</label>
                <textarea name="idioms" rows="2"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-indigo-200">{{ old('idioms', $word->idioms) }}</textarea>
            </div>

            @if ($word->image)
                <div>
                    <label class="block text-gray-700 font-medium">Current Image:</label>
                    <img src="{{ asset('storage/' . $word->image) }}" alt="Word Image"
                        class="h-32 mt-2 rounded-lg shadow">
                </div>
            @endif

            <div>
                <label class="block text-gray-700 font-medium">Change Image:</label>
                <input type="file" name="image" class="w-full border border-gray-300 rounded-lg p-2">
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-4 py-2 bg-indigo-500 text-white rounded-lg shadow hover:bg-indigo-600 transition">
                    Update Word
                </button>

                <a href="{{ url()->previous() }}"
                    class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layout>
