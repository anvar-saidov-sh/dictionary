<?php

namespace App\Http\Controllers;

use App\Models\WordRequest;
use App\Models\Words;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WordRequestController extends Controller
{
    public function create($letter, $wordId)
    {
        $word = Words::findOrFail($wordId);
        return view('words.request', compact('word', 'letter'));
    }

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
    public function approve($id)
    {
        $wr = WordRequest::with('word')->findOrFail($id);

        $ownerId = $wr->word->student_id ?? null;
        $me = Auth::guard('student')->id();

        if ($ownerId !== $me) {
            abort(403, 'Only the word owner can approve requests.');
        }

        $word = $wr->word;
        $word->definition = $wr->definition ?? $word->definition;
        $word->examples   = $wr->examples   ?? $word->examples;
        $word->idioms     = $wr->idioms     ?? $word->idioms;
        if (!empty($wr->image)) {
            $word->image = $wr->image;
        }
        $word->save();

        $wr->status = 'approved';
        $wr->save();

        return redirect()->route('dashboard')->with('success', 'Request approved and word updated.');
    }

    public function reject($id)
    {
        $wr = WordRequest::with('word')->findOrFail($id);

        $ownerId = $wr->word->student_id ?? null;
        $me = Auth::guard('student')->id();

        if ($ownerId !== $me) {
            abort(403, 'Only the word owner can reject requests.');
        }

        $wr->status = 'rejected';
        $wr->save();

        return redirect()->route('dashboard')->with('info', 'Request rejected.');
    }
}
