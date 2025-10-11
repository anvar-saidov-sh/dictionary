<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-700 mb-6 text-center sm:text-left">
            Your Profile
        </h1>

        <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-sm">
            <table class="min-w-full text-sm text-gray-700">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700">
                        <th class="px-4 py-3 border-b text-xs sm:text-sm">#</th>
                        <th class="px-4 py-3 border-b text-xs sm:text-sm">Name</th>
                        <th class="px-4 py-3 border-b text-xs sm:text-sm">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 border-b text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 border-b break-words">{{ $student->name }}</td>
                            <td class="px-4 py-3 border-b break-words">{{ $student->email }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                                No students found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="sm:hidden mt-6 space-y-4">
            @forelse ($students as $student)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                    <p class="text-sm text-gray-500">#{{ $loop->iteration }}</p>
                    <h2 class="text-lg font-semibold text-indigo-700 mt-1">{{ $student->name }}</h2>
                    <p class="text-gray-600 text-sm mt-1">{{ $student->email }}</p>
                </div>
            @empty
                <p class="text-gray-500 text-center">No students found.</p>
            @endforelse
        </div>
    </div>
</x-layout>
