<?php

namespace App\Http\Controllers;

use App\Models\Words;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $validated['student_id'] = Auth::guard('student')->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('words', 'public');
        }

        $validated['status'] = 'pending';
        $validated['verified'] = false;
        $validated['reviewed_by_scholar'] = false;

        Words::create($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Word created and sent for scholar review.');
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

        $words = Words::published()
            ->whereRaw('LOWER(name) LIKE ?', [strtolower($letter) . '%'])
            ->get();

        return view('words.show', compact('letter', 'words'));
    }

    public function review($letter, Words $word)
    {
        $isScholar = Auth::guard('scholar')->check();


        return view('words.review', compact('letter', 'word'));
    }

    public function edit($letter, Words $word)
    {
        if ($word->student_id !== Auth::guard('student')->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('words.edit', compact('letter', 'word'));
    }

    public function update($letter, Request $request, Words $word)
    {
        if ($word->student_id !== Auth::guard('student')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'definition' => 'required|string|max:500',
            'examples' => 'nullable|string|max:1000',
            'idioms' => 'nullable|string|max:200',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('words', 'public');
        }

        $validated['status'] = 'pending';
        $validated['reviewed_by_scholar'] = false;
        $validated['approved_by_scholar'] = null;

        $word->update($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Word updated and resubmitted for scholar review.');
    }

    public function destroy($letter, Words $word)
    {
        if ($word->student_id !== Auth::guard('student')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $word->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Word deleted successfully.');
    }
    public function approveByScholar($id)
    {
        $word = Words::where('status', 'pending')
        ->findOrFail($id);

        $scholarId = Auth::guard('scholar')->id();



        $word->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Request approved and applied successfully.');
    }

    public function rejectByScholar($id)
    {
        $word = Words::where('status', 'pending')->findOrFail($id);

        $word->update([
            'status' => 'rejected',
            'scholar_id' => Auth::guard('scholar')->id(),
        ]);

        return back()->with('info', 'Request rejected by scholar.');
    }

}
