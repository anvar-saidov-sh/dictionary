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
            'status' => 'pending_owner',
        ]);

        return back()->with('success', 'Request submitted successfully and is awaiting word owner review.');
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
    public function approveByOwner($id)
    {
        $requestItem = WordRequest::findOrFail($id);
        if ($requestItem->word->student_id !== auth()->guard('student')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $requestItem->update(['status' => 'pending_scholar']);

        return back()->with('success', 'Request approved and sent to scholars for final review.');
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
    public function rejectByOwner($id)
    {
        $requestItem = WordRequest::findOrFail($id);

        if ($requestItem->word->student_id !== auth()->guard('student')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $requestItem->update(['status' => 'rejected']);

        return back()->with('info', 'Request rejected. It will not be sent to scholars.');
    }
    public function approveByScholar($id)
    {
        $req = WordRequest::where('status', 'pending_scholar')->findOrFail($id);
        $scholarId = auth()->guard('scholar')->id();

        $req->update([
            'status' => 'approved',
            'scholar_id' => $scholarId,
        ]);

        $word = $req->word;
        if ($req->definition) $word->definition = $req->definition;
        if ($req->examples) $word->examples = $req->examples;
        if ($req->idioms) $word->idioms = $req->idioms;
        $word->save();

        return back()->with('success', 'Request approved and applied to the word.');
    }
    public function rejectByScholar($id)
    {
        $req = WordRequest::where('status', 'pending_scholar')->findOrFail($id);

        $req->update([
            'status' => 'rejected',
            'scholar_id' => auth()->guard('scholar')->id(),
        ]);

        return back()->with('info', 'Request rejected by scholar.');
    }
}
