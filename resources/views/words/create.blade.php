<x-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl p-8">
            <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Add New Word</h1>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <strong>Whoops!</strong> Something went wrong:
                    <ul class="list-disc list-inside text-sm mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('words.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Word</label>
                    <input type="text" name="name" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Definition</label>
                    <textarea name="definition" required maxlength="500" rows="3"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Max 500 characters</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Examples</label>
                    <textarea name="examples" maxlength="1000" rows="3"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Max 1000 characters</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Idioms</label>
                    <textarea name="idioms" maxlength="200" rows="2"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Max 200 characters</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="image">Image</label>
                    <input type="file" name="image" id="image"
                        class="mt-1 w-full text-sm text-gray-600 border border-gray-300 rounded-lg cursor-pointer
                               file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                               file:text-sm file:font-semibold
                               file:bg-indigo-50 file:text-indigo-700
                               hover:file:bg-indigo-100">
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg font-semibold shadow-md
                               hover:bg-indigo-700 hover:shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                         Save Word
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
