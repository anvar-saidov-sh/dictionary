<x-navfooter>
    <section class="min-h-screen flex flex-col items-center justify-start bg-gray-100 py-8">
        <div class="w-full max-w-4xl bg-white p-8 rounded-lg shadow-lg">

            <h1 class="text-2xl font-bold mb-6">
                Welcome, <span class="text-indigo-600">{{ $scholar->name }}</span>
            </h1>

            <div class="flex flex-col gap-3 mb-8">
                <a href="{{ route('scholar.pendingwords') }}"
                    class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                    Pending Created Words
                </a>
                <a href="{{ route('scholar.pendingrequests') }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    Pending Word Requests
                </a>
                <a href="{{ route('scholar.reviewedwords') }}"
                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                    Reviewed Words
                </a>
                <a href="{{ route('scholar.reviewedrequests') }}"
                    class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition">
                    Reviewed Word Requests
                </a>
            </div>
        </div>
    </section>
</x-navfooter>
