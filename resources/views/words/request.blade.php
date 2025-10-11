<x-layout>
    <section class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
        <div class="w-full max-w-2xl bg-white p-6 sm:p-8 rounded-2xl shadow-lg">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 text-center">
                Request Changes for: <span class="text-indigo-600">{{ $word->word }}</span>
            </h2>

            <form action="{{ route('words.requests.store', [$letter, $word->id]) }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Definition</label>
                    <textarea name="definition" rows="3" required
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm text-sm sm:text-base
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('definition') }}</textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Examples</label>
                    <textarea name="examples" rows="3"
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm text-sm sm:text-base
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('examples') }}</textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Idioms</label>
                    <textarea name="idioms" rows="3"
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm text-sm sm:text-base
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('idioms') }}</textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Message (to the owner)</label>
                    <textarea name="message" rows="3"
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm text-sm sm:text-base
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('message') }}</textarea>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold shadow-md
                               hover:bg-indigo-700 hover:shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                        Send Request
                    </button>

                    <a href="{{ url()->previous() }}"
                        class="w-full sm:w-auto px-6 py-3 bg-gray-400 text-white rounded-lg font-semibold shadow-md
                               hover:bg-gray-500 hover:shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-0.5 text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </section>
</x-layout>
