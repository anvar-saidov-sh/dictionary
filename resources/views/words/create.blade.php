<x-layout>
    <h1>Add New Word</h1>

    @if ($errors->any())
        <div>
            <strong>Whoops!</strong> Something went wrong.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('words.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Word:</label>
        <input type="text" name="name" required><br>

        <label>Definition:</label>
        <textarea name="definition" required maxlength="500"></textarea><br>

        <label>Examples:</label>
        <textarea name="examples" maxlength="1000"></textarea><br>

        <label>Idioms:</label>
        <textarea name="idioms" maxlength="200"></textarea><br>

        <label>Image:</label>
        <input type="file" name="image"><br><br>

        <button type="submit">Save Word</button>
    </form>
</x-layout>
