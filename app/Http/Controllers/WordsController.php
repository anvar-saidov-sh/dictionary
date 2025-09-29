<?php

namespace App\Http\Controllers;

use App\Models\Words;
use Doctrine\Inflector\Rules\Word;
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

        $student = auth()->guard('student')->user();
        $student->words()->create($validated);

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

        $words = Words::whereRaw('LOWER(name) LIKE ?', [strtolower($letter) . '%'])->get();
        return view('words.show', compact('letter', 'words'));
    }
    public function review(Word $word){
        return view('words.review', compact('word'));
    }
    public function edit(Request $request)
    {
        return view('words.edit');
    }
    public function destroy(Request $request)
    {
        return view('words.edit');
    }
}
