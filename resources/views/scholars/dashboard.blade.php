<x-navfooter>
    <section class="min-h-screen flex flex-col items-center justify-start bg-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl bg-white p-6 sm:p-8 rounded-lg shadow-lg">

            <h1 class="text-xl sm:text-2xl font-bold mb-6 text-center sm:text-left">
                Welcome, <span class="text-indigo-600">{{ $scholar->name }}</span>
            </h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-8">
                <a href="{{ route('scholar.pendingwords') }}"
                   class="px-4 py-3 text-center bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition font-medium">
                    Pending Created Words
                </a>

                <a href="{{ route('scholar.pendingrequests') }}"
                   class="px-4 py-3 text-center bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition font-medium">
                    Pending Word Requests
                </a>

                <a href="{{ route('scholar.reviewedwords') }}"
                   class="px-4 py-3 text-center bg-green-500 text-white rounded-lg hover:bg-green-600 transition font-medium">
                    Reviewed Words
                </a>

                <a href="{{ route('scholar.reviewedrequests') }}"
                   class="px-4 py-3 text-center bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition font-medium">
                    Reviewed Word Requests
                </a>
            </div>
        </div>
    </section>
</x-navfooter>
