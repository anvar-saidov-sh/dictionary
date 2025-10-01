<?php

namespace App\Http\Controllers;

use App\Models\WordRequest;
use App\Models\Words;
use Illuminate\Http\Request;

class WordRequestController extends Controller
{
    // Show request form
    public function create($letter, $wordId)
    {
        $word = Words::findOrFail($wordId);
        return view('words.request', compact('word', 'letter'));
    }

    // Store request
    public function store(Request $request, $letter, $wordId)
    {
        $request->validate([
            'definition' => 'required|string',
            'examples' => 'nullable|string',
            'idioms' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        WordRequest::create([
            'word_id' => $wordId,
            'student_id' => auth()->guard('student')->id(),
            'definition' => $request->definition,
            'examples' => $request->examples,
            'idioms' => $request->idioms,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->route('words.review', [$letter, $wordId])
            ->with('success', 'Your request has been sent to the owner.');
    }
}
