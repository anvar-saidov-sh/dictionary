<x-layout>
    @php
        $specials = [
            'Oʻ' => 'o-',
            'Gʻ' => 'g-',
            'Sh' => 'sh',
            'Ch' => 'ch',
        ];
    @endphp

    <section class="bg-gray-100 min-h-screen flex flex-col items-center px-4 sm:px-6 lg:px-8 py-10">
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-2xl p-6 sm:p-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 text-center mb-8">
                Browse Words by Alphabet
            </h1>

            <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 xl:grid-cols-12 gap-3 sm:gap-4 justify-items-center">
                @foreach (range('A', 'Z') as $alphabet)
                    @if ($alphabet != 'C' && $alphabet != 'W')
                        <a href="{{ route('words.show', strtolower($alphabet)) }}"
                            class="w-12 h-12 sm:w-14 sm:h-14 flex items-center justify-center rounded-lg border border-gray-300
                                   bg-gray-50 text-lg sm:text-xl font-semibold text-gray-800 shadow-sm
                                   hover:bg-indigo-600 hover:text-white hover:shadow-md transition duration-200 ease-in-out">
                            {{ $alphabet }}
                        </a>
                    @endif
                @endforeach

                @foreach ($specials as $letter => $slug)
                    <a href="{{ route('words.show', $slug) }}"
                        class="w-12 h-12 sm:w-14 sm:h-14 flex items-center justify-center rounded-lg border border-gray-300
                               bg-gray-50 text-lg sm:text-xl font-semibold text-gray-800 shadow-sm
                               hover:bg-indigo-600 hover:text-white hover:shadow-md transition duration-200 ease-in-out">
                        {{ $letter }}
                    </a>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                <form action="{{ route('words.create') }}" method="get" class="w-full sm:w-auto">
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold shadow-md
                               hover:bg-indigo-700 hover:shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-0.5 text-sm sm:text-base">
                        Add New Word
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-layout>
