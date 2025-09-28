<x-layout>
    @php
        $specials = [
            'Oʻ' => 'o-',
            'Gʻ' => 'g-',
            'Sh' => 'sh',
            'Ch' => 'ch',
        ];
    @endphp

    <section class="bg-gray-100 min-h-screen flex flex-col items-center">
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-2xl mt-10 p-6">
            <h1 class="text-2xl font-bold text-gray-800 text-center mb-6"> Browse Words by Alphabet</h1>

            <div class="grid grid-cols-6 sm:grid-cols-8 md:grid-cols-10 gap-4 justify-items-center">
                @foreach (range('A', 'Z') as $alphabet)
                    @if ($alphabet != 'C' && $alphabet != 'W')
                        <a href="{{ url(`/words/` . strtolower($alphabet)) }}"
                            class="w-14 h-14 flex items-center justify-center rounded-lg border border-gray-300
                              bg-gray-50 text-xl font-semibold text-gray-800 shadow-sm
                              hover:bg-indigo-600 hover:text-white hover:shadow-md transition duration-200 ease-in-out">
                            {{ $alphabet }}
                        </a>
                    @endif
                @endforeach

                @foreach ($specials as $letter => $slug)
                    <a href="{{ url(`/words/` . $slug) }}"
                        class="w-14 h-14 flex items-center justify-center rounded-lg border border-gray-300
                          bg-gray-50 text-xl font-semibold text-gray-800 shadow-sm
                          hover:bg-indigo-600 hover:text-white hover:shadow-md transition duration-200 ease-in-out">
                        {{ $letter }}
                    </a>
                @endforeach
            </div>

            <div class="mt-8 text-center">
                <form action="{{ route('words.create') }}" method="get">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-semibold shadow-md
                               hover:bg-indigo-700 hover:shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                        Add New Word
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-layout>
