<?php

namespace App\Http\Controllers;

use App\Models\Words;
use Illuminate\Http\Request;

class WordsController extends Controller
{
    public function index()
    {
        return view('words.index');
    }

    public function create()
    {
        return view('words.create'); // ✅ fixed
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'definition' => 'required|string',
            'examples' => 'nullable|string',
            'idioms' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('words', 'public');
        }

        auth()->guard()->user()->words()->create($validated);

        return redirect()->route('index')->with('success', 'Word created successfully!');
    }

public function show($char)
{
    $map = [
        'o-' => 'Oʻ',
        'g-' => 'Gʻ',
        'sh' => 'Sh',
        'ch' => 'Ch',
    ];

    $letter = $map[$char] ?? strtoupper($char);

    $words = Words::where('name', 'LIKE', $letter . `%`)->get();

    return view('words.show', compact('letter', 'words'));
}

}
