<x-layout>
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('info'))
        <div class="mb-4 p-3 bg-yellow-100 text-yellow-700 rounded-lg">
            {{ session('info') }}
        </div>
    @endif

    <section class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-3xl bg-white shadow-lg rounded-xl p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                Welcome, <span class="text-indigo-600">{{ auth()->guard('student')->user()->name }}</span>
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
                <button onclick="toggleModal('myRequestsModal')"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">
                    My Requests
                </button>
                <button onclick="toggleModal('incomingRequestsModal')"
                    class="px-4 py-2 bg-purple-500 text-white rounded-lg shadow hover:bg-purple-600 transition">
                    Requests on My Words
                </button>
            </div>

            <h2 class="text-xl font-semibold text-gray-700 mb-4">Your Words</h2>
            @if ($words->count() > 0)
                <ul class="space-y-4 mb-8">
                    @foreach ($words as $word)
                        <li class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border">
                            <span class="text-gray-800 font-medium">{{ $word->name }}</span>
                            <div class="flex gap-2 items-center">
                                <a href="{{ route('words.edit', [strtoupper(substr($word->name, 0, 1)), $word->id]) }}"
                                    class="px-3 py-1 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 transition">
                                    Edit
                                </a>
                                <form
                                    action="{{ route('words.destroy', [strtoupper(substr($word->name, 0, 1)), $word->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this word?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 mb-8">You haven’t created any words yet.</p>
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

    <div id="myRequestsModal"
        class="fixed inset-0 bg-blur bg-opacity-50 hidden backdrop-blur-[3px] items-center justify-center ">
        <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg relative">
            <button onclick="toggleModal('myRequestsModal')"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-5xl cursor-pointer">&times;</button>
            <h2 class="text-xl font-semibold mb-4">Requests You Made</h2>
            @if ($myRequests->count())
                <ul class="space-y-4">
                    @foreach ($myRequests as $req)
                        <li class="p-3 bg-gray-50 rounded-lg border">
                            <p class="text-gray-800">
                                On word <span class="font-bold">{{ $req->word->name ?? 'Deleted Word' }}</span> –
                                Status: <span class="italic">{{ $req->status }}</span>
                            </p>
                            <p class="text-sm text-gray-600">Definition: {{ $req->definition }}</p>
                            @if ($req->examples)
                                <p class="text-sm text-gray-600">Example: {{ $req->examples }}</p>
                            @endif
                            @if ($req->idioms)
                                <p class="text-sm text-gray-600">Idiom: {{ $req->idioms }}</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">You haven’t made any requests yet.</p>
            @endif
        </div>
    </div>

    <div id="incomingRequestsModal"
        class="fixed inset-0 bg-blur bg-opacity-50 hidden backdrop-blur-[3px] items-center justify-center">
        <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg relative">
            <button onclick="toggleModal('incomingRequestsModal')"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-5xl cursor-pointer">&times;</button>
            <h2 class="text-xl font-semibold mb-4">Requests On Your Words</h2>
            @if ($incomingRequests->count())
                <ul class="space-y-4">
                    @foreach ($incomingRequests as $req)
                        <li class="p-3 bg-gray-50 rounded-lg border">
                            <p class="text-gray-800">
                                Request by <span class="font-bold">{{ $req->student->name ?? 'Unknown' }}</span>
                                for your word <span class="font-bold">{{ $req->word->name ?? 'Deleted Word' }}</span>
                            </p>
                            <p class="text-sm text-gray-600">Definition: {{ $req->definition }}</p>
                            @if ($req->examples)
                                <p class="text-sm text-gray-600">Example: {{ $req->examples }}</p>
                            @endif
                            @if ($req->idioms)
                                <p class="text-sm text-gray-600">Idiom: {{ $req->idioms }}</p>
                            @endif
                            <div class="flex gap-2 mt-2">
                                <form action="{{ route('requests.approve', $req->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('requests.reject', $req->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No one has requested changes to your words yet.</p>
            @endif
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            } else {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        }
    </script>
</x-layout>
