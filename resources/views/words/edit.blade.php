<x-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-50 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-3xl bg-white shadow-md rounded-2xl p-6 sm:p-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-indigo-700 mb-6 text-center">
                Edit Word Details
            </h1>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5 text-sm sm:text-base">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('words.update', [$letter, $word->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Word:</label>
                    <p class="w-full border border-gray-100 bg-gray-100 rounded-lg p-2 sm:p-3 font-bold capitalize text-sm sm:text-base">
                        {{ $word->name }}
                    </p>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Definition:</label>
                    <textarea name="definition" rows="3" required
                        class="w-full border border-gray-300 rounded-lg p-2 sm:p-3 text-sm sm:text-base focus:ring-2 focus:ring-indigo-200 focus:outline-none">{{ old('definition', $word->definition) }}</textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Examples:</label>
                    <textarea name="examples" rows="3"
                        class="w-full border border-gray-300 rounded-lg p-2 sm:p-3 text-sm sm:text-base focus:ring-2 focus:ring-indigo-200 focus:outline-none">{{ old('examples', $word->examples) }}</textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Idioms:</label>
                    <textarea name="idioms" rows="2"
                        class="w-full border border-gray-300 rounded-lg p-2 sm:p-3 text-sm sm:text-base focus:ring-2 focus:ring-indigo-200 focus:outline-none">{{ old('idioms', $word->idioms) }}</textarea>
                </div>

                @if ($word->image)
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Current Image:</label>
                        <img src="{{ asset('storage/' . $word->image) }}" alt="Word Image"
                            class="h-32 sm:h-40 mt-2 rounded-lg shadow-md mx-auto sm:mx-0">
                    </div>
                @endif

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Change Image:</label>
                    <input type="file" name="image"
                        class="w-full border border-gray-300 rounded-lg text-sm sm:text-base file:mr-4 file:py-2 file:px-4
                               file:rounded-lg file:border-0 file:text-sm file:font-semibold
                               file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>

                <div class="flex flex-col sm:flex-row justify-center sm:justify-start gap-3 pt-4">
                    <button type="submit"
                        class="w-full sm:w-auto px-4 py-2 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition duration-200">
                        Update Word
                    </button>

                    <a href="{{ url()->previous() }}"
                        class="w-full sm:w-auto px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition duration-200 text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
