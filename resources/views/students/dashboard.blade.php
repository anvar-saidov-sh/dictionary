<x-layout>
    <section class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-3xl bg-white shadow-lg rounded-xl p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                Welcome, <span class="text-indigo-600">{{ auth()->user()->name }}</span>
            </h1>

            <div class="flex gap-4 mb-6">
                <a href="{{ route('words.create') }}"
                    class="px-4 py-2 bg-indigo-500 text-white rounded-lg shadow hover:bg-indigo-600 transition">
                    Create Word
                </a>

                <a href="{{ route('index') }}"
                    class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">
                    Words List
                </a>
            </div>
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Your Words</h2>

            @if ($words->count() > 0)
                <ul class="space-y-4">
                    @foreach ($words as $word)
                        <li class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border">
                            <span class="text-gray-800 font-medium">{{ $word->name }}</span>
                            <div class="flex gap-2 items-center">
                                <a href="{{ route('words.edit', [strtoupper(substr($word->name, 0, 1)), $word->id]) }}"
                                    class="px-3 py-1 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 transition cursor-pointer">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('words.destroy', [strtoupper(substr($word->name, 0, 1)), $word->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this word?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">You haven’t created any words yet.</p>
            @endif

            <form action="{{ route('logout') }}" method="post" class="mt-6">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition">
                    Logout
                </button>
            </form>
        </div>
    </section>
</x-layout>
