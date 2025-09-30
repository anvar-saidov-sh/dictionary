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
        return view('words.create');
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

        $validated['student_id'] = auth()->guard()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('words', 'public');
        }

        Words::create($validated);

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
    public function review($letter, Words $word)
    {
        return view('words.review', compact('letter','word'));
    }

    public function edit($letter, Words $word)
    {
        if ($word->student_id !== auth()->guard()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('words.edit', compact('letter', 'word'));
    }

    public function update($letter, Request $request, Words $word)
    {
        if ($word->student_id !== auth()->guard()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'definition' => 'required|string|max:500',
            'examples' => 'nullable|string|max:1000',
            'idioms' => 'nullable|string|max:200',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('words', 'public');
        }

        $word->update($validated);

        return redirect()->route('dashboard')->with('success', 'Word updated successfully!');
    }

    public function destroy($letter, Words $word)
    {
        if ($word->student_id !== auth()->guard()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $word->delete();

        return redirect()->route('dashboard')->with('success', 'Word deleted successfully!');
    }
}
